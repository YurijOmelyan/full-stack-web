<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote for the best programming language</title>
<style>
form{   
    display: flex;
    flex-direction: column;
    width:max-content;
}
</style>
</head>
<script>const a = 5;</script>
<body>
    <form action = "votingResults.php" method="post">
        <h2>Make your choice:</h2>
        <?php 
        $file = $_SERVER['DOCUMENT_ROOT']."/base/base.json";
        $json  = file_get_contents($file);
        $arr = json_decode($json,true);
        foreach($arr as $key => $value) {
            echo '<label><input type="radio" name="selectedValue" value="'.$value.'">'.$value.'</label>';
        };
        ?>
        <input type="submit" value="Show voting result">
    </form>
    
</body>
</html>