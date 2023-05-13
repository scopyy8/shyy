<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school";
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>

<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>family</th>
        <th>edit</th>
        <th>update</th>
    </tr>

    <?php
    $query = "SELECT * FROM student";
    $result = $db->prepare($query);
    $result->execute();
    while($a=$result->fetch(PDO::FETCH_ASSOC)){
        echo " 
<tr>
<td>" . $a['id'] . "</td>
<td>" . $a['name'] . "</td>
<td>" . $a['family'] . "</td>

<td><a href='index.php?delete=" . $a['id'] . "'>delete</a> </td>
    <td><a href='index.php?update=" . $a['id'] . "'>update</a> </td>
</tr>
";
    }
    ?>

</table>
<form method="post">
    <label>id</label>
    <input type="text" name="id" >
    <label>name</label>
    <input type="text" name="name" >
    <label>family</label>
    <input type="text" name="family" >
    <input type="submit" name="submit1" value="run">
</form>

<?php
if (isset($_POST['submit1'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $family=$_POST['family'];
    $query="INSERT INTO student(id,name,family) values ($id,'$name','$family')";
    $result = $db->prepare($query);
    $result->execute();
}

if (isset($_POST['submit2'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $family=$_POST['family'];
    $query="UPDATE student SET id=".$id.",name=' ".$name." ' ".",family=' ".$family." ' WHERE id=".$id;
    $result=$db->prepare($query);
    $result->execute();
}

?>
<?php
if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $query="delete  from student where id=".$id;
    $result=$db->prepare($query);
    $result->execute();
}

?>
<?php
if (isset($_GET['update'])){
    $id=$_GET['update'];
    $query=" select * from student where id=". $id;
    $result=$db->prepare($query);
    $result->execute();
    $a=$result->fetch(PDO::FETCH_ASSOC);
    echo '
 <form method="post">
 <fieldset>
 <legend> name</legend>
 <label>id</label>
    <input type="text" name="id" value="'.$a['id'] .'" >
    <label>name</label>
    <input type="text" name="name"  value="'.$a['name'] .'" >
    <label>family</label>
    <input type="text" name="family"  value="'.$a['family'] .'" >
    <input type="submit" name="submit2" >
 </form>
 </fieldset>
 ';
}
?>
