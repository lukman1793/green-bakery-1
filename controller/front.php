<?php

include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Front {

    protected $db, $host, $redirect;

    function __construct() {
        // code...
        $this->db = new database();
        $this->host = new config();
        $this->redirect = new Redirect();
        $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
        
    }

    function index() {

        $execute_get_all_barang = $this->db->query("SELECT * FROM tbl_barang");
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");

        if(Session::exists('id_pelanggan')){
            $query = "SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan');
            $keranjang = $this->db->query($query)->fetch_assoc();
        }

        include './view/front/main.php';
    }

    function register(){
        if(!Session::exists('email')){

            $kategori = $this->db->query("SELECT nama FROM tbl_kategori");

            include './view/front/autentikasi/register.php';

        } else {
            $this->redirect->to('front/');
        }
    }

    function process_register(){

        $data_ok = true;

        $nama_lengkap = Input::post('nama_lengkap');
        $email = Input::post('email');
        $no_telepon = Input::post('no_telepon');
        $password = md5(Input::post('password'));

        $check_data = [$nama_lengkap, $email, $no_telepon, $password];

        for($i = 0; $i < count($check_data); $i++){
            if(empty($check_data[$i])){
                $data_ok = false;
            }
        }

        if ($data_ok){

            $query = "INSERT INTO `tbl_pelanggan`(`nama_lengkap`, `email`, `no_telp`, `password`) VALUES ('$nama_lengkap','$email','$no_telepon','$password')";

            if(Input::post('password') == Input::post('re_password')){
                $result = $this->db->query($query);
            
                if($result){
                    print " <script>
                                window.location='".$this->redirect->get_url('front/login')."';
                                alert('Registrasi Berhasil!');
                            </script>";
                } else {
                    print " <script>
                                window.location='".$this->redirect->get_url('front')."';
                                alert('Registrasi Gagal!');
                            </script>";
                }
            } else {
                print " <script>
                            window.location='".$this->redirect->get_url('front/register')."';
                            alert('Password Konfirmasi tidak sesuai');
                        </script>";
            }
        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('front/register')."';
                        alert('Data Registrasi Belum Lengkap');
                    </script>";
        }
    }

    function login(){
        if(!Session::exists('email')){

            $kategori = $this->db->query("SELECT nama FROM tbl_kategori");

            include './view/front/autentikasi/login.php';
        } else {
            $this->redirect->to('front');
        }
    }

    function process_login(){
        if(Input::post('submit')){

            $email = Input::post('email');
            $password = md5(Input::post('password'));

            $query = "SELECT * FROM tbl_pelanggan WHERE email = '$email' AND password = '$password'";
            $login = $this->db->query($query);

            if($login->num_rows > 0){

                $data_pelanggan = $login->fetch_assoc();

                Session::set('id_pelanggan', $data_pelanggan['id']);
                Session::set('email', $data_pelanggan['email']);
                Session::set('nama_pelanggan', $data_pelanggan['nama_lengkap']);

                print " <script>
                            window.location='".$this->redirect->get_url('front')."';
                            alert('Login Berhasil!');
                        </script>";
            } else {
                print " <script>
                            window.location='".$this->redirect->get_url('front/login')."';
                            alert('email atau Password Salah!');
                        </script>";
            }
            
        } else {
            $this->redirect->to('front/login');
        }
    }

    function logout(){
        session_destroy();
        $this->redirect->to('front');
    }
	
    function kategori(){
        $id_kategori = Input::get('id_kategori');

        $data_kue = $this->db->query("SELECT * FROM tbl_barang WHERE id_kategori = '$id_kategori'");
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");
        if(Session::exists('id_pelanggan')){
            $keranjang = $this->db->query("SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan'))->fetch_assoc();
        }

        include './view/front/kategori/daftar_kue.php';
    }

    function detail_kue(){
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");
        $detail = $this->db->query("SELECT * FROM tbl_barang WHERE id =".Input::get("id_kue"))->fetch_assoc();
        if(Session::exists('id_pelanggan')){
            $keranjang = $this->db->query("SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan'))->fetch_assoc();
        }

        include "./view/front/kategori/detail_kue.php";
    }

    function tambah_keranjang(){
        if(Session::exists('email')){
            
            $id_pelanggan = Session::get('id_pelanggan');
            $id_barang = Input::get('id_kue');
            $qty = Input::post('qty');

            $data = $this->db->query("SELECT harga, qty FROM tbl_barang WHERE id = $id_barang")->fetch_array();
            
            $qty_update = $data[1] - $qty;
            $query_update = "UPDATE tbl_barang SET qty = $qty_update WHERE id = $id_barang";
            $update_data = $this->db->query($query_update);

            $data_keranjang = $this->db->query("SELECT id_barang, id_pelanggan, qty FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan')." AND id_barang = $id_barang")->fetch_assoc();

            if(empty($data_keranjang)){
                $subtotal = $data[0] * $qty;
                $query_insert = "INSERT INTO tbl_keranjang(id_pelanggan, id_barang, qty, subtotal) VALUES (".Session::get('id_pelanggan').", ".Input::get('id_kue').", $qty, $subtotal)";
                $insert_data = $this->db->query($query_insert);
            } else {
                $total_qty = $data_keranjang['qty'] + $qty;
                $insert_data = $this->db->query("UPDATE tbl_keranjang SET qty = $total_qty WHERE id_barang = ".$data_keranjang['id_barang']." AND id_pelanggan = ".$data_keranjang['id_pelanggan']);
            }   

            if(!empty($insert_data)) {
                print " <script>
                            window.location='".$this->redirect->get_url('keranjang')."';
                            alert('Berhasil di simpan');
                        </script>";
            }

        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('front/login')."';
                        alert('Anda Harus Login Terlebih Dahulu.');
                    </script>";
        }
    }

    function pesanan(){

        if(Session::exists('email')) {

        $kategori = $this->db->query("SELECT id, nama FROM tbl_kategori");

        $keranjang = $this->db->query("SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan'))->fetch_assoc();

        $query_pesanan = "SELECT pengiriman.*, transaksi.* FROM tbl_transaksi AS transaksi JOIN tbl_pengiriman AS pengiriman ON pengiriman.id_transaksi = transaksi.id_transaksi
                          WHERE transaksi.id_pelanggan = ".Session::get('id_pelanggan');

        $list_pemesanan = $this->db->query($query_pesanan);

        include './view/front/pesanan/list_pesanan.php';

        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('front/login')."';
                        alert('Anda Harus Login Terlebih Dahulu.');
                    </script>";
        }

    }

    function detail_pesanan() {

        if(Session::exists('email')) {

            $total = 0;

            $id_transaksi = Input::get('id');

            $query = "SELECT tbl_barang.foto, tbl_detail_transaksi.* FROM tbl_detail_transaksi JOIN tbl_barang ON tbl_barang.nama_barang = tbl_detail_transaksi.nama_barang 
                      WHERE tbl_detail_transaksi.id_transaksi = '$id_transaksi'";

            $detail_pesanan = $this->db->query($query);

            $transaksi = $this->db->query("SELECT tbl_transaksi.*, tbl_pengiriman.* FROM tbl_transaksi JOIN tbl_pengiriman ON tbl_transaksi.id_transaksi = tbl_pengiriman.id_transaksi
                                           WHERE tbl_transaksi.id_transaksi = '$id_transaksi'")->fetch_assoc();

            $kategori = $this->db->query("SELECT id, nama FROM tbl_kategori");

            include './view/front/pesanan/detail_pesanan.php';

        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('front/login')."';
                        alert('Anda Harus Login Terlebih Dahulu.');
                    </script>";
        }

    }

    function verifikasi_pembayaran() {

        $id_transaksi = Input::get('id');

        $check = $this->db->query("SELECT disetujui FROM tbl_pembayaran WHERE id_transaksi = '$id_transaksi'")->fetch_array();

        if ($check[0] == 0 || empty($check)) {

            $kategori = $this->db->query("SELECT id, nama FROM tbl_kategori");

            include "./view/front/verifikasi_pembayaran.php";

        } else {

            print " <script>
                        window.location='$this->host/front/detail_pesanan/?id=$id_transaksi';
                        alert('Pembayaran telah di setujui.');
                    </script>";
        }


    }

    function verifikasi_bukti(){

        $id_transaksi = Input::get('id');

        $check = $this->db->query("SELECT disetujui FROM tbl_pembayaran WHERE id_transaksi = '$id_transaksi'")->fetch_array();

        if($check[0] == 0 || empty($check)) {
            
            $direktori_upload   = "./uploads/bukti_pembayaran";

            if(!$_FILES["foto"]["error"] && $_FILES['foto']['error'] != 4) {

                $direktori_sementara= $_FILES["foto"]["tmp_name"];
                $nama_file = basename($_FILES["foto"]["name"]);

                move_uploaded_file($direktori_sementara, "$direktori_upload/$nama_file");

                $query = "INSERT INTO tbl_pembayaran (id_transaksi, foto_bukti, disetujui) VALUES ('$id_transaksi', '$nama_file', 0)";

                $this->db->query($query);
                
                print " <script>
                            window.location='$this->host/front/detail_pesanan/?id=$id_transaksi';
                            alert('Pembayaran telah di simpan.');
                        </script>";

            } else {

                print " <script>
                            window.location='$this->host/front/verifikasi_bukti/?id=$id_transaksi';
                            alert('Pembayaran gagal di simpan.');
                        </script>";

            }

        } else if ($check[0] != 0 || !empty($check)) {

            print " <script>
                        window.location='$this->host/front/detail_pesanan/?id=$id_transaksi';
                        alert('Pembayaran telah di setujui.');
                    </script>";

        }

    }


    function ganti_password(){
        if(Session::exists('id_pelanggan')){

            $kategori = $this->db->query("SELECT nama FROM tbl_kategori");

            include './view/front/ganti_password.php';
         } else {
            $this->redirect->to('front');
        }
    }


    // function proses_gantipassword(){
    //     $data_ok = true;
    //     $id    = $_POST['id'];

    //     $email                  = Input::post('email');
    //     $password               = Input::post('password_lama');
    //     $password_baru          = Input::post('password_baru');
    //     $konfirmasi_password    = Input::post('konfirmasi_password');

    //     $check_data = [$password, $password_baru, $konfirmasi_password];
        
    //     for($i = 0; $i < count($check_data); $i++){
    //         if(empty($check_data[$i])){
    //             $data_ok = false;
    //         }
    //     }

    //     if ($data_ok){

    //         $query = "UPDATE tbl_pelanggan SET password='$password', WHERE id = $id";

    //         if(Input::post('password') == Input::post('re_password')){
    //             $result = $this->db->query($query);
            
    //             if($result){
                    
    //                 print " <script>
    //                             window.location='".$this->redirect->get_url('front/ganti_password')."';
    //                             alert('ganti password Berhasil!');
    //                         </script>";
    //             } else {
    //                 print " <script>
    //                             window.location='".$this->redirect->get_url('front')."';
    //                             alert('ganti password Gagal!');
    //                         </script>";
    //             }
    //         } 
    //     } 
    // }

    // proses ganti_password

    function proses_gantipassword(){
        $id_pelanggan           = Session::get('id_pelanggan');
        $password               = Input::post('password_lama');
        $password_baru          = Input::post('password_baru');
        $konfirmasi_password    = Input::post('konfirmasi_password');

    
    $query = "SELECT * FROM tbl_pelanggan WHERE id = $id_pelanggan AND password = '".md5($password)."'";
    $result = $this->db->query($query);

        if ($result->num_rows > 0){
            
            if($password_baru === $konfirmasi_password){
                $query = "UPDATE tbl_pelanggan SET password='".md5($password_baru)."' WHERE id='$id_pelanggan'";

                $result = $this->db->query($query);

                print " <script>
                        window.location='".$this->redirect->get_url('front/ganti_password')."';
                        alert('ganti password Berhasil!');
                        </script>";
            }
        }
    }

}