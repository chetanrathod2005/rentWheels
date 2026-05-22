    <?php
    include '../../db.php';
    session_start();
    $user_id=$_SESSION['user_id'];
    $car_name=$_POST['car_name'];
    $car_rent=$_POST['rent'];
   
    $license=$_POST['license'];
    $book_from=$_POST['date_from'];
    $book_to=$_POST['date_to'];

    $document = $_FILES['document']['name'];
    $documentTmp  = $_FILES['document']['tmp_name'];
    $fileSize = $_FILES['document']['size'];
    $fileError= $_FILES['document']['error'];

    if(empty($car_name) || empty($car_rent) || empty($license) ||
        empty($book_from) ||empty($book_to)) {
        die("All fields are required");
    }

    /* document validation */

    if(empty($document)) {
        die("Document is required");
    }

    $maxSize = 2 * 1024 * 1024;

    $fileExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($fileExt, $allowed)) {

        if ($fileError === 0) {

            if ($fileSize <= $maxSize) {

                $document = time() . "_"  . $fileExt;

                $target_dir = "../../assets/images/documents/" .$document;

                if (move_uploaded_file($documentTmp, $target_dir)) {
                    echo "Document Uploaded Successfully!";
                } else {
                    echo "Upload Document Is Not Valid";
                }

            } else {
                echo "Document size not more than 2MB accept!";
            }

        } else {
            echo "Document error!";
        }

    } else {
        echo "Invalid file type! Only JPG, JPEG, PNG, PDF allowed.";
    }

    date_default_timezone_set("Asia/Kolkata");

    $booking_time = date("Y-m-d H:i:s");
    $stmt=$conn->prepare("INSERT INTO fw_booking
    (user_id,car_name,car_rent,
    license,book_from,book_to,document,book_time)
    VALUES (?,?,?,?,?,?,?,?)
    ");
    $stmt->bind_param("isisssss",$user_id,$car_name,$car_rent,
    $license,$book_from,$book_to,$document,$booking_time);

    if($stmt->execute()) {
        echo "Your Booking Request Is Send";
    }
    $stmt->close();
    
     // send notification to admin
    $stmt=$conn->prepare("SELECT 
    u.name,
    b.car_name,
    b.user_id,
    b.book_from,
    b.book_to
    FROM users u
    JOIN  fw_booking b
    ON
    u.id=b.user_id
    WHERE 
    b.user_id=?
    ORDER BY b.id DESC
    LIMIT 1
    ");
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $result=$stmt->get_result();
    $booking=$result->fetch_assoc();
    $msg = "Request is received for " . $booking['car_name'] . " from " . $booking['name']." for
    Date ".$booking['book_from']. " to " .$booking['book_to'];
    date_default_timezone_set("Asia/Kolkata");

    $msg_time = date("Y-m-d H:i:s");
    $adminQuery = "SELECT id FROM users WHERE role='admin' ";
    $adminResult = $conn->query($adminQuery);
    $admin = $adminResult->fetch_assoc();
    $admin_id = $admin['id'];

    $sql = "INSERT INTO notifications (user_id, message,created_at) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss",$admin_id, $msg,$msg_time);
    $stmt->execute();

   
    ?>