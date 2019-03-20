<?php
session_start();
include 'koneksi.php';
        require('pdf/fpdf.php');
            $query_data = "";
            $query_barang = "";
            $query_hitung = "";
            $total_semua = 0;
            $query_untung = "";
            $pdf = new FPDF('p','mm','A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',18);
            $pdf->Cell(27,21,'',1,0,'C');
            $pdf->Image('icon/wiclo.jpeg',10,10,40);
            
            $pdf->Cell(160,7,'Wiclo ',0,1,'C');
            $pdf->Cell(27,7,'',0,0,'C');
            $pdf->Cell(160,7,'Jl.untung suropati no.30, Kampung jawa,',0,1,'C');
            $pdf->Cell(27,7,'',0,0,'C');
            $pdf->Cell(160,7,'kota praya, lombok tengah',0,1,'C');
            $pdf->Cell(200,7,'',0,1,'C');
            $pdf->Cell(200,7,'',0,1,'C');
            $pdf->SetFont('Arial','',12);
            
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(10,7,'-----------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1);
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(200,30,$_SESSION['kata'],0,1,'C');
            // cek tanggal
            $query = $_SESSION['query'];
            $query_data = mysqli_query($conn, $query);

            $pdf->SetFont('Arial','',10);
            $pdf->Cell(10,5,'No',1,0,'C');
            $pdf->Cell(24,5,'Waktu',1,0,'C');
            $pdf->Cell(30,5,'Kode Barang',1,0,'C');
            $pdf->Cell(50,5,'Nama Barang',1,0,'C'); 
            $pdf->Cell(30,5,'Harga',1,0,'C');
            $pdf->Cell(15,5,'jumlah',1,0,'C');
            $pdf->Cell(30,5,'Subtotal',1,1,'C');
            
//            $pdf->Cell(405,5,'',1,1,'C');
            
            $no = 1;
            while( $data = mysqli_fetch_assoc($query_data)){
               $pdf->SetFont('Arial','',10);
                $query_barang = mysqli_query($conn, "select b.id_barang as id, b.nama_barang as nama, sum(dt.jumlah_jual) as jumlah, b.harga as harga, (sum(dt.jumlah_jual)*b.harga) as sub_total from barang b join detil_penjualan dt on b.id_barang=dt.id_barang join penjualan p on dt.id_penjualan=p.id_penjualan where ".$_SESSION['kat']."(p.tgl_penjualan)='".$data['tgl']."' group by b.ID_BARANG");
                $hitung = mysqli_num_rows($query_barang);
                $p = 5*$hitung;
                $pdf->Cell(10,$p,$no,1,0,'C');
                $pdf->Cell(24,$p,$data['tgl'],1,0,'C');
//                $pdf->Cell(90,5,$data['total'],1,1,'C');
                $t = 1;
                $total = 0;
                while($data_barang = mysqli_fetch_assoc($query_barang)){
                    $pdf->Cell(30,5,$data_barang['id'],1,0,'C');
                    $pdf->Cell(50,5,$data_barang['nama'],1,0,'C'); 
                    $pdf->Cell(30,5,'Rp.'.$data_barang['harga'],1,0,'C');
                    $pdf->Cell(15,5,$data_barang['jumlah'],1,0,'C');
                    $pdf->Cell(30,5,'Rp.'.$data_barang['sub_total'],1,1,'C');
                    $total = $total + $data_barang['sub_total'];
                    if ($t<$hitung) {
                        # code...
                        $pdf->Cell(1,5,'',0,0,'C');
                        $pdf->Cell(3,5,'',0,0,'C');
                        $pdf->Cell(10,5,'',0,0,'C');
                        $pdf->Cell(10,5,'',0,0,'C');
                        $pdf->Cell(10,5,'',0,0,'C');
                    }
                    $t++;
                }
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(144,5,'',1,0,'C');
                $pdf->Cell(15,5,'Total',1,0,'C');
                
                $pdf->Cell(30,5,'Rp.'.$total,1,1,'C');
                $total_semua = $total_semua + $total; 
                
            $no++;
            }
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(139,5,'',1,0,'C');
                $pdf->Cell(20,5,'Total Akhir',1,0,'C');
                
                $pdf->Cell(30,5,'Rp.'.$total_semua,1,1,'C');
                
        $pdf->Output();
           unset($_SESSION['kata']);
         unset($_SESSION['query']);
?>
<script>
    //    window.print();

</script>
