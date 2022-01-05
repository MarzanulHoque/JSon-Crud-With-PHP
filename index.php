<?php
include_once('config.php');
$books = array();
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURD OPERATION USING FILE SYSTEM</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">

    <!-- <script>
        function search() {
            let searchvalue = document.getElementById('search_input').value
            let books = [];
            $.ajax({
                url: "search.php",
                data: {
                    'searcValue': searchvalue
                },
                success: function(result) {
                    console.log(result);
                }
            })
        }
    </script> -->
</head>

<body>
     <div class="container">

        <div class="alert alert-primary mt-2 text-center" role="alert">
            <h3>JSon File Manipulation Using PHP</h3>
        </div>
    </div>

    <div class="index_search_div">
        <a href="/create.php" class="create_btn btn-info">Add Book</a>
        <?php
        $newBooks = array();
        if (isset($_POST['submit'])) {
            $searchBy = $_POST['search'];
            if (strlen($searchBy) > 0) {
                foreach ($books as $key => $value) {
                    if ($value['title'] == $searchBy) {
                        array_push($newBooks, $value);
                    }
                }
                $books = $newBooks;
            }
        }
        ?>
        <form method="post" class="index_search_div_inner">
            <input class="search_box" id="search_input" name="search" type="search" placeholder="Seach.......">
            <input class="create_btn" type="submit" value="Search" name="submit">
        </form>
        <!-- <button onclick="search()">CLICK</button> -->
        <!-- <div class="index_search_div_inner">      
        </div> -->
    </div>

    <table class="table  table-hover table-dark" style="width: 80%;margin:1rem auto;  background-color: rgb(241, 241, 241);">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Available</th>
            <th>Pages</th>
            <th>Isbn</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $key => $value) :  ?>
            <tr>
                <td><?php echo $value['title'] ?></td>
                <td><?php echo $value['author'] ?></td>
                <td><?php if ($value['available']) {
                        echo "YES";
                    } else {
                        echo "NO";
                    }  ?></td>
                <td><?php echo $value['pages'] ?></td>
                <td><?php echo $value['isbn'] ?></td>
                <td>
                    <a type='button' class='btn btn-warning' href="<?php echo $BASE_URL . '/' . '/delete.php?id=' . $value['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>
