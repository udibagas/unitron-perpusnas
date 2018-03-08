<?php
	/**
		* Script:    DataTables server-side script for PHP 5.2+ and MySQL 4.1+
		* Notes:     Based on a script by Allan Jardine that used the old PHP mysql_* functions.
		*            Rewritten to use the newer object oriented mysqli extension.
		* Copyright: 2010 - Allan Jardine (original script)
		*            2012 - Kari Söderholm, aka Haprog (updates)
		* License:   GPL v2 or BSD (3-point)
	*/
	include "../koneksi.php";
	
	@session_start();

	$req = $_SESSION['id_req'];
	$ss = $konek->query("SELECT MAX(id_req)+1 as up FROM request");
			$dd = $ss->fetch_assoc();

			$kode_req=$dd['up'];

	mb_internal_encoding('UTF-8');

	/**
		* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
	*/
	$aColumns = array( 'sub_ruang_id', 'ruang_id', 'sub_ruang_no', 'sub_ruang_name'); //Kolom Pada Tabel

	// Indexed column (used for fast and accurate table cardinality)
	$sIndexColumn = 'sub_ruang_id';

	// DB table to use
	$sTable = 'sub_ruang'; // Nama Tabel

	// Database connection information


	// Input method (use $_GET, $_POST or $_REQUEST)
	$input =& $_POST;

	$gaSql['charset']  = 'utf8';

	/**
		* MySQL connection
	*/



	/**
		* Paging
	*/
	$sLimit = "";
	if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );
	}


	/**
		* Ordering
	*/
	$aOrderingRules = array();
	if ( isset( $input['iSortCol_0'] ) ) {
		$iSortingCols = intval( $input['iSortingCols'] );
		for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
			if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
				$aOrderingRules[] =
                "`".$aColumns[ intval( $input['iSortCol_'.$i] ) ]."` "
                .($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');
			}
		}
	}

	if (!empty($aOrderingRules)) {
		$sOrder = " ORDER BY ".implode(", ", $aOrderingRules);
		} else {
		$sOrder = "";
	}


	/**
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
	*/
	$iColumnCount = count($aColumns);

	if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {
		$aFilteringRules = array();
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {
				$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$konek->real_escape_string( $input['sSearch'] )."%'";
			}
		}
		if (!empty($aFilteringRules)) {
			$aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
		}
	}

	// Individual column filtering
	for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
		if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
			$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$konek->real_escape_string($input['sSearch_'.$i])."%'";
		}
	}

	if (!empty($aFilteringRules)) {
		$sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
		} else {
		$sWhere = " ";
	}

	/**
		* SQL queries
		* Get data to display
	*/
	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}

	$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", $aQueryColumns)."`
    FROM `".$sTable."`".$sWhere.$sOrder.$sLimit;

	$rResult = $konek->query( $sQuery ) or die($konek->error);

	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = $konek->query( $sQuery ) or die($konek->error);
	list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

	// Total data set length
	$sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM `".$sTable."`";
	$rResultTotal = $konek->query( $sQuery ) or die($konek->error);
	list($iTotal) = $rResultTotal->fetch_row();
	/**
		* Output
	*/
	$output = array(
    "sEcho"                => intval($input['sEcho']),
    "iTotalRecords"        => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData"               => array(),
	);

	// Looping Data
	// 
	
	$no=1;
	while ( $aRow = $rResult->fetch_assoc() ) {
		$row = array();
		$btn = '<a href="#" onClick="showModals(\''.$aRow['sub_ruang_id'].'\')" class="btn btn-info btn-sm">Edit</a> | <a href="#" onClick="deleteUser(\''.$aRow['sub_ruang_id'].'\')" class="btn btn-danger btn-sm">delete</a>';
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}
		$kid = $aRow['ruang_id'];
		$sql1=$konek->query("SELECT ruang_name FROM ruang WHERE ruang_id='$kid'");
		$data = $sql1->fetch_assoc();

		$row = array( $btn, $no++, $data['ruang_name'], $aRow['sub_ruang_no'], $aRow['sub_ruang_name']);
		$output['aaData'][] = $row;
	}

	echo json_encode( $output );

?>
