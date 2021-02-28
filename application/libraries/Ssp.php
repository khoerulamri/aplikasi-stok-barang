<?php
class SSP {
	/**
	 * Create the data output array for the DataTables rows
	 *
	 *  @param  array $columns Column information array
	 *  @param  array $data    Data from the SQL get
	 *  @return array          Formatted data in a row based format
	 */
	static function data_output ( $columns, $data )
	{
		$out = array();
		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();
			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				if (isset( $column['alias'] )){
					if ($column['alias']!= '' ){
						$c = $column['alias'];
					}else{
						$c = $column['db'];
					}	
				}else{
					$c = $column['db'];
				}
				
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] =  utf8_encode($column['formatter']( $data[$i][ $c ], $data[$i] ));
				}
				else {
					$row[ $column['dt'] ] =  utf8_encode($data[$i][ $c ]);
				}
			}
			$out[] = $row;
		}
		return $out;
	}
	/**
	 * Paging
	 *
	 * Construct the LIMIT clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL limit clause
	 */
	static function limit ( $request, $columns )
	{
		$limit = '';
		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['length'])." OFFSET ".intval($request['start']);
		}
		return $limit;
	}
	/**
	 * Ordering
	 *
	 * Construct the ORDER BY clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL order by clause
	 */
	static function order ( $request, $columns )
	{
		$order = '';
		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			$dtColumns = self::pluck( $columns, 'dt' );
			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';
					$orderBy[] = $column['db'].' '.$dir;
				}
			}
			$order = 'ORDER BY '.implode(', ', $orderBy);
		}
		return $order;
	}
	/**
	 * Searching / Filtering
	 *
	 * Construct the WHERE clause for server-side processing SQL query.
	 *
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here performance on large
	 * databases would be very poor
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL where clause
	 */
	static function filter ( $request, $columns, $filtroAdd )
	{
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns = self::pluck( $columns, 'dt' );
		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];
			$str = pg_escape_string($str);
			$str = explode(" ",$str);
			for($h=0;$h<count($str);$h++){
				for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
					$requestColumn = $request['columns'][$i];
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					$column = $columns[ $columnIdx ];
					$var = $str[$h];
					if(substr($column['db'],-4)=='date'){
						$kolom = "to_char(".$column['db'].",'DD-MON-YYYY')";
					}
					else{
						$kolom = $column['db'];
					}
					if ( $requestColumn['searchable'] == 'true' ) {
						$globalSearch[$h][] = " {$kolom}::varchar ILIKE UPPER('$var')";
					}
				}
			}
		}
		// Individual column filtering
		for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
			$requestColumn = $request['columns'][$i];
			$columnIdx = array_search( $requestColumn['data'], $dtColumns );
			$column = $columns[ $columnIdx ];
			$str = $requestColumn['search']['value'];
			$str = pg_escape_string($str);
			if ( $requestColumn['searchable'] == 'true' &&
			 $str != '' ) {
				$columnSearch[] = " {$column['db']}::varchar ILIKE '%$str%'";
			}
		}
		// Combine the filters into a single string
		$where = '';
		
		if ( count( $globalSearch ) ) {
			for($h=0;$h<count($globalSearch);$h++){
				if($h!=count($globalSearch)-1){
					$where = $where.'('.implode(' OR ', $globalSearch[$h]).') AND ';
				}else{
					$where = $where.'('.implode(' OR ', $globalSearch[$h]).')';
				}
			}
		}
		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode(' AND ', $columnSearch) :
				$where .' AND '. implode(' AND ', $columnSearch);
		}
		//Make personalized general filter
		if ($filtroAdd !== NULL ){
			if ( $where !== '' ) {
				$where = $filtroAdd.' AND '.$where;
			} else {
				$where = $filtroAdd;
			}						
		}
		
		if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}
		return $where;
	}
	/**
	 * Perform the SQL queries needed for an server-side processing requested,
	 * utilising the helper functions of this class, limit(), order() and
	 * filter() among others. The returned array is ready to be encoded as JSON
	 * in response to an SSP request, or can be modified if needed before
	 * sending back to the client.
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $pg_details SQL connection details - see sql_connect()
	 *  @param  string $table SQL table to query
	 *  @param  string $primaryKey Primary key of the table
	 *  @param  array $columns Column information array
	 *  @return array Server-side processing response array
	 */
	static function simple ( $request, $pg_details, $table, $primaryKey, $columns, $filtroAdd=NULL )
	{
		$db = self::pg_connect( $pg_details );
		
		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $filtroAdd );
		$select = "SELECT ".implode(", ", self::pluckas($columns))."
			 , count(*) OVER() AS full_count
			 FROM $table			 
			 $where
			 $order
			 $limit";

    	$result = pg_query( $db, $select ) or self::fatal("Failed to execute the query.\n". pg_last_error()."\n $select");
    	$data = pg_fetch_all($result);
		// print_r($data);
		// exit();
 		$recordsFiltered = $data[0]['full_count'];
		if ($filtroAdd !== NULL){
			$where = " WHERE $filtroAdd ";
		}else{
			$where = "";
		}
		$resTotalLength = pg_query( $db,"SELECT COUNT({$primaryKey}) FROM $table $where" );
		$recordsTotalRow = pg_fetch_row($resTotalLength);
		$recordsTotal = $recordsTotalRow[0];
		pg_free_result( $result );
		pg_free_result( $resTotalLength );
		
		return array(
		 	"draw"            => intval( $request['draw'] ),
		 	"recordsTotal"    => intval( $recordsTotal ),
		 	"recordsFiltered" => intval( $recordsFiltered ),
		 	"data"            => self::data_output( $columns, $data ),
			"where"			=> $select
		 );
	}
	
	/**
	 * Connect to the database
	 *
	 * @param  array $pg_details SQL server connection details array, with the
	 *   properties:
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 * @return resource Database connection handle
	 */
	static function pg_connect( $pg_details )
	{
		$db =  pg_connect("
			host={$pg_details['host']} 
			dbname={$pg_details['db']} 
			user={$pg_details['user']} 
			password={$pg_details['pass']}") or self::fatal("DB connection error.\n". pg_last_error()) ;
		return $db;
	}
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */
	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param  string $msg Message to send to the client
	 */
	static function fatal ( $msg )
	{
		echo json_encode( array( 
			"error" => $msg
		) );
		exit(0);
	}

	/**
	 * Pull a particular property from each assoc. array in a numeric array, 
	 * returning and array of the property values from each item.
	 *
	 *  @param  array  $a    Array to get data from
	 *  @param  string $prop Property to read
	 *  @return array        Array of property values
	 */
	static function pluck ( $a, $prop )
	{
		$out = array();
		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}
		return $out;
	}
	
	/**
	 * Pull a particular property from each assoc. array in a numeric array, 
	 * returning and array of the property values from each item.
	 *
	 *  @param  array  $a    Array to get data from
	 *  @return array        Array of property values
	 */
	static function pluckas ( $a )
	{
		$out = array();
		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			if ( isset( $a[$i]['alias'] ) ) {
				if ($a[$i]['alias']!=''){
					$out[] = $a[$i]['db']." AS ".$a[$i]['alias'];
				}else{
					$out[] = $a[$i]['db'];
				}
			}else{
				$out[] = $a[$i]['db'];
			}
		}
		return $out;
	}	
}