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

		function get_os(){ //Sementara
		
			$q = $this->db->query("
				SELECT ROUND(qtyavg) as pemesananAvg, ROUND(AVG(qtyos)) as terkirimAvg
				FROM 
				(
				    SELECT AVG(A.Qty) AS qtyavg, (SUM(A.Qty) - SUM(A.QtyTemp)) AS qtyos
				    FROM do_d A
				)inner_query
			");
			
			return $q->result();
		}

		function get_total_os(){ //Sementara
		
			$q = $this->db->query("
				SELECT SUM(Qty) AS pemesananTotal, (SUM(Qty) - SUM(QtyTemp)) AS terkirimTotal 
				FROM do_d
			");
			
			return $q->result();
		}

		function get_keuangan(){ //Sementara
		
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

		function get_total_keuangan(){ //Sementara
		
			$q = $this->db->query("
				SELECT SUM(Grand) AS invoiceTotal, (SUM(Grand) - SUM(Temp)) AS terbayarTotal 
				FROM invoice
			");
			
			return $q->result();
		}

		function get_detail_penjualan($date)
        {

            $this->db->select('A.No_Do, A.Tgl, A.grandttl, B.Perusahaan');
			$this->db->from('do_h A');
			$this->db->join('pelanggan B', 'B.Kode = A.Kode_Plg', 'LEFT');
			$this->db->where('A.Tgl =', $date);
			$this->db->order_by("A.Tgl", "desc");

			$q = $this->db->get();
            return $q->result();
        }
	}