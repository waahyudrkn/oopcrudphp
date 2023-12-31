<?php

/**
 * Class Auth untuk melakukan pengguna  dan registrasi user baru
 */
class Auth
{
    /**
     * @var
     * Menyimpan Koneksi database
     */
    private $database;

    /**
     * @var
     * Menyimpan Error Message
     */
    private $error;

    /**
     * @param $database_conn
     * Contructor untuk class Auth, membutuhkan satu parameter yaitu koneksi ke database
     */
    public function __construct($database_conn)
    {
        $this->db = $database_conn;

        // Mulai session
        session_start();
    }
    /**
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     *
     * Registrasi User baru
     */
    public function register($name, $email, $password)
    {
        try {
            // buat hash dari password yang dimasukkan
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            //Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO pengguna (name, email, password) VALUES(:name, :email, :pass)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $hashPasswd);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Jika terjadi error

            if ($e->errorInfo[0] == 23000) {
                //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                $this->error = "Email sudah digunakan!";

                return false;
            } else {
                echo $e->getMessage();

                return false;
            }
        }
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     *
     * fungsi pengguna  user
     */
    public function login ($email, $password)
    {
        try {
            // Ambil data dari database
            $stmt = $this->db->prepare("SELECT * FROM pengguna  WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch();

            // Jika jumlah baris > 0
            if ($stmt->rowCount() > 0) {
                // jika password yang dimasukkan sesuai dengan yg ada di database
                if (password_verify($password, $data['password'])) {
                    $_SESSION['user_session'] = $data['id'];

                    return true;
                } else {
                    $this->error = "Email atau Password Salah";

                    return false;
                }
            } else {
                $this->error = "Email atau Password Salah";

                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * @return true|void
     *
     * fungsi cek pengguna  user
     */
    public function isLoggedIn()
    {
        // Apakah user_session sudah ada di session

        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    /**
     * @return false
     *
     * fungsi ambil data user yang sudah pengguna 
     */
    public function getUser()
    {
        // Cek apakah sudah pengguna 
        if (!$this->isLoggedIn()) {
            return false;
        }

        try {
            // Ambil data user dari database
            $stmt = $this->db->prepare("SELECT * FROM pengguna  WHERE id = :id");
            $stmt->bindParam(":id", $_SESSION['user_session']);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * @return true
     *
     * fungsi Logout user
     */
    public function logout()
    {
        // Hapus session
        session_destroy();
        // Hapus user_session
        unset($_SESSION['user_session']);

        return true;
    }

    /**
     * @return mixed
     *
     * fungsi ambil error terakhir yg disimpan di variable error
     */
    public function getLastError()
    {
        return $this->error;
    }
}