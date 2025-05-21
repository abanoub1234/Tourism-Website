<?php
include 'config.php';
session_start();
$userId = $_SESSION['user_id'];
if (!isset($userId)) {
    header('location:login.php');
}

if (isset($_GET['about'])) {
    header('location:about.php');
}

if (isset($_GET['logout'])) {
    unset($userId);
    session_destroy();
    header('location:login.php');
}
$productData = mysqli_query($conn, "SELECT * FROM `areas` WHERE user_Id  = '$userId'") or die('query failed');

//-----------------------------------
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/' . $image;

    //---------------------
    if ($image_size > 2000000) {
        $message[] = 'image size is too large!';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO `areas`(name, areaDes, image, price,user_id) VALUES('$name', '$productDescription', '$image', '$productPrice','$userId')") or die('query failed');

        if ($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            header('location:areas.php');
            $message1[] = 'A new tourist place has been successfully added';
        } else {
            $message[] = 'Failed to add a new tourist place';
        }
    }
}
//----------------------------------------------------
$userdata = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$userId'") or die('query failed');
$user = mysqli_fetch_array($userdata);
$userImage = 'images/' . $user['image'];
//------------------------------------------------------------

if (isset($_POST['deleteAccount'])) {
    mysqli_query($conn, "DELETE FROM areas WHERE user_id = '$userId'");
    mysqli_query($conn, "DELETE FROM user WHERE id = '$userId'");
    mysqli_close($conn);
    session_destroy();
    header('location: home.php');
}
//------------------------------------------------
if (isset($_GET['productidtoedite'])) {
    $productid = $_GET['productidtoedite'];

    mysqli_query($conn, "DELETE FROM areas WHERE id ='$productid'");
    mysqli_close($conn);
    header('location: areas.php');
}
//-----------------------------------------------
if (isset($_GET['productidtodelete'])) {
    $productid = $_GET['productidtodelete'];

    mysqli_query($conn, "DELETE FROM areas WHERE id ='$productid'");
    mysqli_close($conn);
    header('location: areas.php');
}

//-----------------------------------------------
$type = '';
$rtype = 'hidden';
if (isset($_GET['productidtoshow'])) {
    $type = 'hidden';
    $rtype = '';
    $productid = $_GET['productidtoshow'];
    $productData = mysqli_query($conn, "SELECT * FROM `areas` WHERE id = '$productid'") or die('query failed');
    $Productd = mysqli_fetch_array($productData);
}
if (isset($_POST['back'])) {
    header('location:areas.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Tourist Areas in KSA</title>
        <style>
            .message{
                margin:10px 0;
                width: 100%;
                border-radius: 5px;
                padding:10px;
                text-align: center;
                background-color:red;
                color:white;
                font-size: 20px;
            }
            .message1{
                margin:10px 0;
                width: 100%;
                border-radius: 5px;
                padding:10px;
                text-align: center;
                background-color:green;
                color:white;
                font-size: 20px;
            }
            table{
                margin-top: 50px
            }
            td,th{
                background: #ddd;
                color: #333;
                font-size: 20px;
                font-weight: bold;
                border: 5px solid #117a8b;
            }
            header{
                background: #333;
            }
            form{
                background:#ddd;
                width: 630px;
            }
            form label{
                color: black;
                margin-right: 20px
            }
            section h2,p{
                color: black
            }
            footer{
                margin-top: 150px
            }
            .product{
                width: 92%;
            }

            header {
    background: linear-gradient(135deg, #00aaff, #00cc99); /* Vibrant gradient background */
    padding: 5px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%; /* Full width */
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.logo {
    font-size: 24px;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    margin-left: 20px;
}

.nav-links {
    list-style: none;
    display: flex;
    margin-right: 20px;
}

.nav-links li {
    margin: 0 10px; /* Reduced margin for equal spacing */
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    position: relative;
    padding: 10px 20px; /* Increased padding for larger clickable area */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s, transform 0.3s; /* Added transform for movement */
}

.nav-links a:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Subtle white background on hover */
    transform: translateY(-2px); /* Movement effect on hover */
}

.nav-links a::after {
    content: '';
    display: block;
    height: 2px;
    width: 0;
    background: #ffc107; /* Attractive yellow underline */
    transition: width 0.3s;
    position: absolute;
    bottom: -5px; /* Position under the text */
    left: 50%;
    transform: translateX(-50%);
}

.nav-links a:hover::after {
    width: 100%;
}

        </style>
    </head>
    <body style="">
    <header>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo"><a href="home.php">Tourist Areas in KSA</a></h1>
            <ul class="nav-links">
                <li><a href="login.php?logout" onclick="return confirm('Are you sure to log out?')"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="areas.php"><i class="fas fa-map-marked-alt"></i> Tourist Areas</a></li>
                <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </div>
    </nav>
</header>


        <main >

            <img <?php echo $type; ?> style="margin-left: 10;float: left;display: inline;border: 2px solid #ddd;width: 200px;height: 200px;border-radius: 100px;" src="<?php echo $userImage; ?>" alt="" />



        </main>

        <main >

            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            } elseif (isset($message1)) {
                foreach ($message1 as $message1) {
                    echo '<div class="message1">' . $message1 . '</div>';
                }
            }
            ?>


            <table <?php echo $type; ?> style="direction: ltr">

                <tr>
                    <td> Name :</td>
                    <td><?php echo $user['name']; ?></td>
                </tr>
                <tr>
                    <td>EMail : </td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>

                    <td>Delete Acount : </td>
                    <td>
                        <form style="width: 110px" action="" method="post" enctype="multipart/form-data">
                            <button name="deleteAccount"  onclick="return confirm('Are you sure to delete?')" > delete <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>

                </tr>

                <!-- يمكنك إضافة المزيد من المنتجات هنا -->
            </table>
        </main>
        <main>
            <section <?php echo $type; ?> class="intro">
                <h2 style="color:#117a8b; ">Tourist Areas</h2>
                <p>Welcome to our tourist website dedicated to showcasing the beauty and wonders of Saudi Arabia.</p>
            </section>
        </main>

        <main <?php echo $type; ?>>

            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            } elseif (isset($message1)) {
                foreach ($message1 as $message1) {
                    echo '<div class="message1">' . $message1 . '</div>';
                }
            }
            ?>
            <form <?php echo $type; ?> action="" method="post" enctype="multipart/form-data">
                <div class="add">
                    <h2 style="text-align: center;color: #117a8b">Add a New Tourist Area</h2>

                    <label style="margin-left: 20px" for="productImage">Tourist Area Image:</label>
                    <input style="margin-left: 20px"  type="file" name="image" id="productImage" required>

                    <label style="margin-left: 20px" for="productName">Tourist Area Name:</label>
                    <input  placeholder="enter Product Name" type="text" name="name" id="productName" required>

                    <label style="margin-left: 20px" for="productDescription">Tourist Area Description:</label>
                    <textarea placeholder="enter product Description" name="productDescription" id="productDescription" required></textarea>

                    <label style="margin-left: 20px" for="productPrice">Tourist Area Price:</label>
                    <input placeholder="enter Product Price" type="number" name="productPrice" id="productPrice" required>

                    <button style="margin-bottom: 40px;border-radius: 50px;margin-left: 250px" onclick="return confirm('Are you sure?')" type="submit" name="submit">Add Area</button>
                </div>
            </form>
            <table <?php echo $type; ?>>

                <tr>
                    <th>Tourist Area Name</th>
                    <th>Description</th>
                    <th>View</th>
                    <th>edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                if (mysqli_num_rows($productData) > 0) {
                    while ($Product = mysqli_fetch_array($productData)) {
                        $prodId = $Product['id'];
                        echo '
        <tr>
                    <td>' . $Product['name'] . '</td>
                    <td>' . $Product['areaDes'] . '</td>
                    <td><a href="areas.php?productidtoshow=' . $prodId . '"  onclick="return confirm(\'Are you sure?\')">View</button></td>
<td><a href="edit.php?areaId=' . $prodId . '"  onclick="return confirm(\'Are you sure?\')">edit</button></td>
                  
<td><a href="areas.php?productidtodelete=' . $prodId . '" onclick="return confirm(\'Are you sure to delete?\')">Delete</a></td>
                   
                </tr>
            
       
        ';
                    }
                } else {
                    echo ' <tr>
                    <td></td>
                    <td>There are no data.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
                }
                ?>

            </table>

        </main>
        <!--         ----------------------------------------------  -->

        <main <?php echo $rtype; ?>>
            <section <?php echo $rtype; ?> class="intro">
                <h2 style="color:#117a8b; ">Tourist Areas</h2>
                <p>Welcome to our tourist website dedicated to showcasing the beauty and wonders of Saudi Arabia.</p>
           
            </section>

        </main>
        <main <?php echo $rtype; ?>>

            <section <?php echo $rtype; ?> class="products">
                <?php
                if (isset($_GET['productidtoshow']) > 0) {
                    $img = 'images/' . $Productd['image'];

                    echo '<form method="post" enctype="multipart/form-data">
        <div class="product">
            <img src="' . $img . '" alt=" ">
            <h2>' . $Productd['name'] . '</h2>
            <p>' . $Productd['areaDes'] . '.</p>
            <span class="price">' . $Productd['price'] . ' SR</span><br>
                <button name="back">Back</button>
        </div>
                </form>';
                } else {
                    echo '';
                }
                ?>

            </section>
        </main>
        <!--         ----------------------------------------------  -->
        


        <footer style="display: inline;background: #117a8b;">
        <h2 style="color: #fff;">Tourist Areas in KSA</h2>
        </footer>



        <script src="js/script.js"></script>
    </body>
</html>