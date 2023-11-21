<?php
    class cMucTieuThang
    {
        public function index($maND)
        {
            require_once './model/mucTieuThang/mMucTieuThang.php';
            $mMTT = new mMucTieuThang();
            $result = $mMTT->getMucTieuThang($maND);       
            
            $listMTT = [];
            $chuDeThang = 'Chưa thiết lập';
            while ($chiTietMTT = mysqli_fetch_array($result))
            {
                $listMTT[] = $chiTietMTT['noiDung'];
                $chuDeThang = $chiTietMTT['chuDe'];
            }
            
            require_once './view/mucTieuThang/vMucTieuThang.php';
        }

        public function vCreateForm()
        {
            include_once './view/mucTieuThang/vCreateMTT.php';
        }

        public function handleRequest() {
            if (isset($_POST['submitMTT'])) {
                require_once './model/mucTieuThang/mMucTieuThang.php';
                $mMTT = new mMucTieuThang();
                $text1 = $_POST['text1'];
                $ctmt1 = $_POST['ctmt1'];
                $ctmt2 = $_POST['ctmt2'];
                $ctmt3 = $_POST['ctmt3'];
                $maND = $_SESSION['userID'];
                
                $result = $mMTT->saveData($text1, $ctmt1, $ctmt2, $ctmt3, $maND);
                
                if($result == 1)
                {
                    echo "<script>alert('Lưu thành công!')</script>";  
                    header('location: ./?controller=thoiQuen&action=create');
                } else 
                {
                    echo "<script>alert('Gặp lỗi khi lưu!')</script>";  
                }
            }
        }
    }
?>