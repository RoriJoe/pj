<?php
	class Dashboard_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

        function get_date_list($opt){
    		$query = $this->db->query(
    			"SELECT YEAR (Tgl) AS myOpt, YEAR (Tgl) AS myOptTxt
			    FROM do_h
			    GROUP BY YEAR (Tgl)
            ");
            return $query->result();
        }

        function get_info_penjualan($month,$year,$start,$end){
        	if($start != ""){
        		$q = $this->db->query(
        			"SELECT A.VAL AS grandttl,ROUND(AVG(B.Qty)) AS qty
					FROM (
						SELECT ROUND(AVG(grandttl)) AS VAL 
						FROM do_h 
						WHERE Tgl >= '$start' AND Tgl <= '$end'
						) AS A,
	    				(
	    				SELECT SUM(C.Qty) AS Qty FROM do_h B
						LEFT JOIN do_d C ON C.No_do = B.No_Do
						WHERE B.Tgl >= '$start' AND B.Tgl <= '$end'
						GROUP BY B.No_Do
						)AS B
				");
        	}else if($month != ""){
        		$q = $this->db->query(
        			"SELECT A.VAL AS grandttl,ROUND(AVG(B.Qty)) AS qty
					FROM (
						SELECT ROUND(AVG(grandttl)) AS VAL 
						FROM do_h 
						WHERE YEAR(Tgl) = '$year' AND MONTH(Tgl) = '$month'
						) AS A,
	    				(
	    				SELECT SUM(C.Qty) AS Qty FROM do_h B
						LEFT JOIN do_d C ON C.No_do = B.No_Do
						WHERE YEAR(Tgl) = '$year' AND MONTH(Tgl) = '$month'
						GROUP BY B.No_Do
						)AS B
				");
        	}else if($year != ""){
        		$q = $this->db->query(
        			"SELECT A.VAL AS grandttl,ROUND(AVG(B.Qty)) AS qty
					FROM (
						SELECT ROUND(AVG(grandttl)) AS VAL 
						FROM do_h 
						WHERE YEAR(Tgl) = '$year'
						) AS A,
	    				(
	    				SELECT SUM(C.Qty) AS Qty FROM do_h B
						LEFT JOIN do_d C ON C.No_do = B.No_Do
						WHERE YEAR(Tgl) = '$year'
						GROUP BY B.No_Do
						)AS B
				");
        	}else{
        		$q = $this->db->query(
        			"SELECT A.VAL AS grandttl,ROUND(AVG(B.Qty)) AS qty
					FROM (
						SELECT ROUND(AVG(grandttl)) AS VAL 
						FROM do_h 
						) AS A,
	    				(
	    				SELECT SUM(C.Qty) AS Qty 
	    				FROM do_h B
						LEFT JOIN do_d C ON C.No_do = B.No_Do
						GROUP BY B.No_Do
						)AS B
				");
        	}
			return $q->result();
		}
		//NEW QUERY
		function get_penjualan_default($start,$end){
			$q = $this->db->query(
				"SELECT A.Tgl AS Date, SUM(A.grandttl) AS Total
				FROM do_h A
				WHERE A.Tgl >= '$start' AND A.Tgl <= '$end'
				GROUP BY A.Tgl
				ORDER BY A.Tgl DESC
				"
			);
			return $q->result();
		}

		function get_penjualan_revenue($mode,$value){
			if($mode == "rev_great"){
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl) AS Year, SUM(A.grandttl) AS Total
				    FROM do_h A
				    GROUP BY YEAR(A.Tgl) AS Year
				    HAVING SUM(A.grandttl) > '$value'"
				); 
			}else if($mode == "rev_less"){
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl) AS Year, SUM(A.grandttl) AS Total
				    FROM do_h A
				    GROUP BY YEAR(A.Tgl) AS Year
				    HAVING SUM(A.grandttl) < '$value'"
				); 
			}else{
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl) AS Year, SUM(A.grandttl) AS Total
				    FROM do_h A
				    GROUP BY YEAR(A.Tgl)"
				); 
			}
			return $query->result();
		}

		function get_drill_penjualan($year,$month){
			if(!$month){
				$query = $this->db->query(
					"SELECT A.Tgl AS myDate, SUM(A.grandttl) AS Total
					FROM do_h A
					WHERE YEAR(A.tgl) = '$year'
					GROUP BY MONTH(A.Tgl)"
				); 
			}else{
				$query = $this->db->query(
					"SELECT A.Tgl AS myDate, SUM(A.grandttl) AS Total
					FROM do_h A
					WHERE YEAR(A.Tgl) = '$year' AND MONTH(A.Tgl) = '$month'
					GROUP BY A.Tgl
					ORDER BY A.Tgl DESC
				"); 
			}
			return $query->result();
		}

		function get_detail_penjualan($date,$month,$year,$start,$end){
			if($date != ""){
				$query = $this->db->query(
				"SELECT A.No_Do AS No_So, A.Tgl AS Date, A.grandttl AS Total, B.Perusahaan
				FROM do_h A
				LEFT JOIN pelanggan B ON B.Kode = A.Kode_Plg
				WHERE A.Tgl = '$date'
				ORDER BY A.Tgl ASC 	 				
				");
			}else if($start != ""){
				$query = $this->db->query(
				"SELECT A.No_Do AS No_So, A.Tgl AS Date, A.grandttl AS Total, B.Perusahaan
				FROM do_h A
				LEFT JOIN pelanggan B ON B.Kode = A.Kode_Plg
				WHERE A.Tgl >= '$start' AND A.Tgl <= '$end'
				ORDER BY A.Tgl ASC 	 				
				");
			}else if($month != ""){
				$query = $this->db->query(
				"SELECT A.No_Do AS No_So, A.Tgl AS Date, A.grandttl AS Total, B.Perusahaan
				FROM do_h A
				LEFT JOIN pelanggan B ON B.Kode = A.Kode_Plg
				WHERE YEAR(A.Tgl) = '$year' AND MONTH(A.Tgl) = '$month'
				ORDER BY A.Tgl ASC 	
				"); 
			}else if($year != ""){
				$query = $this->db->query(
				"SELECT A.No_Do AS No_So, A.Tgl AS Date, A.grandttl AS Total, B.Perusahaan
				FROM do_h A
				LEFT JOIN pelanggan B ON B.Kode = A.Kode_Plg
				WHERE YEAR(A.Tgl) = '$year'
				ORDER BY A.Tgl ASC"
				); 
			}else{
				$query = $this->db->query(
				"SELECT A.No_Do AS No_So, A.Tgl AS Date, A.grandttl AS Total, B.Perusahaan
				FROM do_h A
				LEFT JOIN pelanggan B ON B.Kode = A.Kode_Plg
				ORDER BY A.Tgl ASC");
			}
			return $query->result();
		}

		function get_outstanding_default($start,$end,$year,$month){
			if(!$start && !$end  && !$year){
				$q = $this->db->query(//all
					"SELECT A.Pesan, B.Kirim
					FROM
					(SELECT COUNT(A.QTyTemp) AS Pesan
						FROM do_d A) AS A,
					(SELECT COUNT(B.QTyTemp) AS Kirim 
						FROM do_d B
						WHERE B.QtyTemp = 0 OR B.QtyTemp NOT LIKE B.Qty) AS B
				");
			}else if(!$year){//range
				$q = $this->db->query(
					"SELECT A.Pesan, B.Kirim
					FROM
					(SELECT COUNT(A.QTyTemp) AS Pesan, C.Tgl 
						FROM do_d A 
						LEFT JOIN do_h C ON C.No_Do = A.No_Do
						WHERE C.Tgl >= '$start' AND C.Tgl <= '$end') AS A,
					(SELECT COUNT(B.QTyTemp) AS Kirim 
						FROM do_d B 
						LEFT JOIN do_h C ON C.No_Do = B.No_Do
						WHERE C.Tgl >= '$start' AND C.Tgl <= '$end' 
						AND (B.QtyTemp = 0 OR B.QtyTemp NOT LIKE B.Qty)) AS B
				");
			}else if(!$month){//year
				$q = $this->db->query(
					"SELECT A.Pesan, B.Kirim
					FROM
					(SELECT COUNT(A.QTyTemp) AS Pesan, C.Tgl 
						FROM do_d A 
						LEFT JOIN do_h C ON C.No_Do = A.No_Do
						WHERE YEAR(C.Tgl) = '$year') AS A,
					(SELECT COUNT(B.QTyTemp) AS Kirim 
						FROM do_d B 
						LEFT JOIN do_h C ON C.No_Do = B.No_Do
						WHERE YEAR(C.Tgl) = '$year' 
						AND (B.QtyTemp = 0 OR B.QtyTemp NOT LIKE B.Qty)) AS B
				");
			}else{//month
				$q = $this->db->query(
					"SELECT A.Pesan, B.Kirim
					FROM(
					    SELECT COUNT(A.QTyTemp) AS Pesan, C.Tgl 
					    FROM do_d A 
					    LEFT JOIN do_h C ON C.No_Do = A.No_Do
					    WHERE YEAR(C.Tgl) = '$year' AND MONTH(C.Tgl) = '$month') AS A,
					(
					    SELECT COUNT(B.QTyTemp) AS Kirim 
					    FROM do_d B 
					    LEFT JOIN do_h C ON C.No_Do = B.No_Do
					    WHERE YEAR(C.Tgl) = '$year' AND MONTH(C.Tgl) = '$month' AND (B.QtyTemp = 0 OR B.QtyTemp NOT LIKE B.Qty)) AS B
				");
			}
			return $q->result();
		}

		function get_detail_os($year,$start,$end,$month){
			if(!$start && !$year && !$end){
				$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Perusahaan as NP, do_h.Tgl, barang.Nama, Ukuran, Qty,QtyTemp, Satuan1,grandttl,do_d.Jumlah
					FROM do_d
					LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
					LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
					LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
				");
			}
			else if(!$year){
				$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Perusahaan as NP, do_h.Tgl, barang.Nama, Ukuran, Qty,QtyTemp, Satuan1,grandttl,do_d.Jumlah
					FROM do_d
					LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
					LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
					LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
					WHERE do_h.Tgl >= '$start' AND do_h.Tgl <= '$end'
				");
			}else if(!$month){
				$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Perusahaan as NP, do_h.Tgl, barang.Nama, Ukuran, Qty,QtyTemp, Satuan1,grandttl,do_d.Jumlah
					FROM do_d
					LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
					LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
					LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
					WHERE YEAR(do_h.Tgl) = '$year'
				");
			}else{
				$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Perusahaan as NP, do_h.Tgl, barang.Nama, Ukuran, Qty,QtyTemp, Satuan1,grandttl,do_d.Jumlah
					FROM do_d
					LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
					LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
					LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
					WHERE YEAR(do_h.Tgl) = '$year' AND MONTH(do_h.Tgl) = '$month'
				");
			}
			return $q->result();
		}

		function get_chart_os($year,$start,$end,$month){
			if(!$start && !$year && !$end){
				$q = $this->db->query(
					"SELECT B.Tgl,COUNT(A.Qty) AS Pesan,
					SUM(case when A.QtyTemp != A.Qty then 1 when A.QtyTemp = 0 then 1 else 0 end) AS Terkirim
					FROM do_d A
					LEFT JOIN do_h B ON A.No_Do = B.No_Do
					GROUP BY YEAR(B.Tgl)
				");
			}
			else if(!$year){
				$q = $this->db->query(
					"SELECT B.Tgl,COUNT(A.Qty) AS Pesan,
					SUM(case when A.QtyTemp != A.Qty then 1 when A.QtyTemp = 0 then 1 else 0 end) AS Terkirim
					FROM do_d A
					LEFT JOIN do_h B ON A.No_Do = B.No_Do
					WHERE B.Tgl >= '2014-01-02' AND B.Tgl <= '2014-02-01'
					GROUP BY B.Tgl
				");
			}else if(!$month){
				$q = $this->db->query(
					"SELECT B.Tgl,COUNT(A.Qty) AS Pesan,
					SUM(case when A.QtyTemp != A.Qty then 1 when A.QtyTemp = 0 then 1 else 0 end) AS Terkirim
					FROM do_d A
					LEFT JOIN do_h B ON A.No_Do = B.No_Do
					WHERE YEAR(B.Tgl) = '$year'
					GROUP BY MONTH(B.Tgl)
				");
			}else{
				$q = $this->db->query(
					"SELECT B.Tgl,COUNT(A.Qty) AS Pesan,
					SUM(case when A.QtyTemp != A.Qty then 1 when A.QtyTemp = 0 then 1 else 0 end) AS Terkirim
					FROM do_d A
					LEFT JOIN do_h B ON A.No_Do = B.No_Do
					WHERE YEAR(B.Tgl) = '$year' AND MONTH(B.Tgl) = '$month'
					GROUP BY B.Tgl
				");
			}
			return $q->result();
		}

		function get_keuangan_default($start,$end,$year,$month){
			if(!$start && !$end && !$year){
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
				");
			}else if(!$year){
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
					WHERE Tgl >= '$start' AND Tgl <= '$end'
				"); 
			}else if(!$month){
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
					WHERE YEAR(Tgl) = '$year'
				");
			}else{
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
					WHERE YEAR(Tgl) = '$year' AND MONTH(Tgl) = '$month'
				");
			}
			return $q->result();
		}

		function get_detail_keuangan($year,$start,$end,$month){
			if(!$start && !$year && !$end){
				$q = $this->db->query("SELECT A.*, pelanggan.Perusahaan
					FROM invoice A
					LEFT OUTER JOIN pelanggan ON A.Kode_Plg = pelanggan.Kode
				");
			}else if(!$year){
				$q = $this->db->query("SELECT A.*, pelanggan.Perusahaan
					FROM invoice A
					LEFT OUTER JOIN pelanggan ON A.Kode_Plg = pelanggan.Kode
					WHERE A.Tgl >= '$start' AND A.Tgl <= '$end'
				");
			}else if(!$month){
				$q = $this->db->query("SELECT A.*, pelanggan.Perusahaan
					FROM invoice A
					LEFT OUTER JOIN pelanggan ON A.Kode_Plg = pelanggan.Kode
					WHERE YEAR(A.Tgl) = '$year'
				");
			}else{
				$q = $this->db->query("SELECT A.*, pelanggan.Perusahaan
					FROM invoice A
					LEFT OUTER JOIN pelanggan ON A.Kode_Plg = pelanggan.Kode
					WHERE YEAR(A.Tgl) = '$year' AND MONTH(A.Tgl) = '$month'
				");
			}
			return $q->result();
		}

		function get_penjualan_compare($year,$month,$start,$end){
			if($start != 0){
				$query = $this->db->query(
					"SELECT A.Tgl AS myDate, SUM(A.Total) AS Total
					FROM do_h A
					WHERE A.Tgl >= '$year-$month-$start' AND A.Tgl <= '$year-$month-$end'
					GROUP BY A.Tgl
					ORDER BY A.Tgl DESC
				");
			}else if(!$month){
				$query = $this->db->query(
					"SELECT A.Tgl AS myDate, SUM(A.Total) AS Total
					FROM do_h A
					WHERE YEAR(A.Tgl) = '$year'
					GROUP BY MONTH(A.Tgl)"
				); 
			}else{
				$query = $this->db->query(
					"SELECT A.Tgl AS myDate, SUM(A.Total) AS Total
					FROM do_h A
					WHERE YEAR(A.Tgl) = '$year' AND MONTH(A.Tgl) = '$month'
					GROUP BY A.Tgl
					ORDER BY A.Tgl DESC
				"); 
			}
			return $query->result();
		}

		function get_pembelian_default($start,$end){
			$q = $this->db->query(
				"SELECT A.Tgl_po AS Date, SUM(A.Total) AS Total
				FROM po_h A
				WHERE A.Tgl_po >= '$start' AND A.Tgl_po <= '$end'
				GROUP BY A.Tgl_po
				ORDER BY A.Tgl_po DESC
				"
			);
			return $q->result();
		}

		function get_drill_pembelian($year,$month){
			if(!$month){
				$query = $this->db->query(
					"SELECT A.Tgl_po AS myDate, SUM(A.Total) AS Total
					FROM po_h A
					WHERE YEAR(A.Tgl_po) = '$year'
					GROUP BY MONTH(A.Tgl_po)"
				); 
			}else{
				$query = $this->db->query(
					"SELECT A.Tgl_po AS myDate, SUM(A.Total) AS Total
					FROM po_h A
					WHERE YEAR(A.Tgl_po) = '$year' AND MONTH(A.Tgl_po) = '$month'
					GROUP BY A.Tgl_po
					ORDER BY A.Tgl_po DESC
				"); 
			}
			return $query->result();
		}

		function get_pembelian_revenue($mode,$value){
			if($mode == "rev_great"){
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl_po) AS Year, SUM(A.Total) AS Total
				    FROM po_h A
				    GROUP BY YEAR(A.Tgl_po)
				    HAVING SUM(A.Total) > '$value'"
				); 
			}else if($mode == "rev_less"){
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl_po) AS Year, SUM(A.Total) AS Total
				    FROM po_h A
				    GROUP BY YEAR(A.Tgl_po)
				    HAVING SUM(A.Total) < '$value'"
				); 
			}else{
				$query = $this->db->query(
					"SELECT YEAR(A.Tgl_po) AS Year, SUM(A.Total) AS Total
				    FROM po_h A
				    GROUP BY YEAR(A.Tgl_po)"
				); 
			}
			return $query->result();
		}

	/*
		function get_penjualan($start, $end){
			$this->db->select('Tgl');
			$this->db->select_sum('grandttl');
			$this->db->from('do_h');
			$this->db->where('Tgl >=', $start);
			$this->db->where('Tgl <=', $end);
			$this->db->group_by("Tgl");
			$this->db->order_by("Tgl", "desc");

			$query = $this->db->get(); 
			return $query->result();
		}

		function get_penjualan_filter($filter, $column){
			$query = $this->db->query("
				SELECT EXTRACT(YEAR from Tgl) AS penjualanYear, SUM(grandttl) AS penjualanTotal
				FROM do_h
				GROUP BY YEAR (Tgl)
			"); 
			return $query->result();
		}

		function get_penjualan_month($filter, $column){
			$query = $this->db->query("
				SELECT MONTH (Tgl) AS penjualanYear, SUM(grandttl) AS penjualanTotal
				FROM do_h
				GROUP BY MONTH (Tgl)
			"); 
			return $query->result();
		}

		function get_larger_revenue($filter, $column){
			$query = $this->db->query("
				SELECT YEAR (Tgl) AS penjualanYear, SUM(grandttl) AS penjualanTotal
			    FROM do_h
			    GROUP BY YEAR (Tgl)
			    HAVING SUM(grandttl) > '$filter'

			"); 
			return $query->result();
		}

		function get_minus_revenue($filter, $column){
			$query = $this->db->query("
				SELECT YEAR (Tgl) AS penjualanYear, SUM(grandttl) AS penjualanTotal
			    FROM do_h
			    GROUP BY YEAR (Tgl)
			    HAVING SUM(grandttl) < '$filter'

			"); 
			return $query->result();
		}

		function get_drill_month($year){
			$query = $this->db->query("
				SELECT Tgl AS penjualanMonth, SUM(grandttl) AS penjualanTotal
				FROM do_h
				WHERE YEAR(Tgl) = '$year'
				GROUP BY MONTH (Tgl)
			    
			"); 
			return $query->result();
		}

		function get_drill_day($year, $month){
			$query = $this->db->query("
				SELECT Tgl, SUM(grandttl) AS grandttl
				FROM do_h
				WHERE YEAR(Tgl) = '$year' AND MONTH(Tgl) = '$month'
				GROUP BY Tgl
				ORDER BY Tgl DESC
			    
			"); 
			return $query->result();
		}

		function get_detail_penjualan($date){

            $this->db->select('A.No_Do, A.Tgl, A.grandttl, B.Perusahaan');
			$this->db->from('do_h A');
			$this->db->join('pelanggan B', 'B.Kode = A.Kode_Plg', 'LEFT');
			$this->db->where('A.Tgl =', $date);
			$this->db->order_by("A.Tgl", "desc");

			$q = $this->db->get();
            return $q->result();
        }
	*/

	/*Gauge
		function get_os(){
		
			$q = $this->db->query("
				SELECT ROUND(AVG(C.tes),2) AS pemesananAvg, ROUND(A.pesan / B.kirim, 2) AS terkirimAvg
				FROM 
				(SELECT COUNT(QtyTemp) AS pesan FROM do_d) AS A,
				(SELECT COUNT(*) AS tes FROM do_h GROUP BY Tgl) AS C,
				(SELECT COUNT(QtyTemp) AS kirim FROM do_d WHERE QtyTemp = 0 OR QtyTemp NOT LIKE Qty) AS B
			");
			
			return $q->result();
		}

		function get_keuangan(){
		
			$q = $this->db->query("
				SELECT ROUND(invoiceavg) as invAvg, ROUND(AVG(terimabyrTotal)) as terbayarAvg
				FROM 
				(
				    SELECT AVG(A.Grand) AS invoiceavg, A.Grand, (sum(A.Grand) - SUM(A.Temp)) as terimabyrTotal
				    FROM invoice A
				)inner_query
			");
			
			return $q->result();
		}

		function get_total_os($start,$end,$year){
			if(!$year){
				$q = $this->db->query("
					SELECT SUM(A.pesanan) AS pemesananTotal, B.kirim AS terkirimTotal
					FROM 
					(
					    SELECT COUNT(C.QtyTemp) AS pesanan 
					    FROM do_d C 
					    LEFT JOIN do_h D ON D.No_Do = C.No_Do
					    WHERE D.Tgl >= '$start' AND D.Tgl <= '$end'
					) AS A, 
					(
						SELECT COUNT(QtyTemp) AS kirim 
					    FROM do_d C
					    LEFT JOIN do_h D ON D.No_Do = C.No_Do
					    WHERE D.Tgl >= '$start' AND D.Tgl <= '$end'
					    AND (C.QtyTemp = 0 OR C.QtyTemp NOT LIKE C.Qty)
					) AS B
				");
			}else{
				$q = $this->db->query("
					SELECT SUM(A.pesanan) AS pemesananTotal, B.kirim AS terkirimTotal
					FROM 
					(
					    SELECT COUNT(C.QtyTemp) AS pesanan 
					    FROM do_d C 
					    LEFT JOIN do_h D ON D.No_Do = C.No_Do
					    WHERE YEAR(D.Tgl) = '$year'
					) AS A, 
					(
						SELECT COUNT(QtyTemp) AS kirim 
					    FROM do_d C
					    LEFT JOIN do_h D ON D.No_Do = C.No_Do
					    WHERE YEAR(D.Tgl) = '$year'
					    AND (C.QtyTemp = 0 OR C.QtyTemp NOT LIKE C.Qty)
					) AS B
				");
			}
			
			return $q->result();
		}

		function get_total_keuangan($start,$end,$year){
			if(!$year){
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
					WHERE Tgl >= '$start' AND Tgl <= '$end'
				");
			}else{
				$q = $this->db->query("
					SELECT IFNULL(SUM(Grand), 0) AS invoiceTotal, IFNULL((SUM(Grand) - SUM(Temp)),0) AS terbayarTotal  
					FROM invoice
					WHERE YEAR(Tgl) = '$year'
				");
			}
			return $q->result();
		}*/

        /*Advance only*/
	}