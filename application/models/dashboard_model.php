<?php
	class Dashboard_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

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

		/*Gauge*/
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
		}

        /*Advance only*/
        function get_date_list($opt){
    		$query = $this->db->query("
                SELECT YEAR (Tgl) AS myOpt, YEAR (Tgl) AS myOptTxt
			    FROM do_h
			    GROUP BY YEAR (Tgl)
            ");
            return $query->result();
        }

        function get_penjualan_last($start,$end,$year){
        	if(!$year){
        		$q = $this->db->query("
					SELECT Tgl, grandttl
					FROM do_h
					WHERE Tgl >= '$start' AND Tgl <= '$end'
					ORDER BY Tgl ASC
					LIMIT 0,10
				");
        	}else{
        		$q = $this->db->query("
					SELECT Tgl, grandttl
					FROM do_h
					WHERE YEAR(Tgl) = '$year'
					ORDER BY Tgl ASC
					LIMIT 0,10
				");
        	}
        	
			return $q->result();
		}

		function get_penjualan_unit($start,$end,$year){
			if(!$year){
				$q = $this->db->query("
					SELECT A.Tgl,SUM(B.Qty) AS unit, ROUND(AVG(B.Qty)) AS unit_avg
					FROM do_h A
					JOIN do_d B ON B.No_Do = A.No_Do
					WHERE Tgl >= '$start' AND Tgl <= '$end'
					GROUP BY A.Tgl
					ORDER BY Tgl ASC
				");
			}else{
				$q = $this->db->query("
					SELECT A.Tgl,SUM(B.Qty) AS unit, ROUND(AVG(B.Qty)) AS unit_avg
					FROM do_h A
					JOIN do_d B ON B.No_Do = A.No_Do
					WHERE YEAR(Tgl) = '$year'
					GROUP BY A.Tgl
					ORDER BY Tgl ASC
				");
			}

			return $q->result();
		}
	}