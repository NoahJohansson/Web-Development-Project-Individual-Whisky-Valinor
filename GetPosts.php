<?php

    $db = new SQLITE3 ('./db/sqlite.db');

    $res = $db->query('SELECT * FROM Posts ORDER BY ID desc'); //Select all values from db Posts
    while ($row = $res->fetchArray()) 
    {
        $temp = $row['email'];
        $res2 = $db->query("SELECT * FROM User WHERE email = '" . SQLite3::escapeString($temp) . "'");
        echo $row["email"];
        echo "<br>";
        if($row2 = $res2->fetchArray())
        {
            echo "<img src='images/".$row2['image']."' width=60 height=60>";
        }
        echo "<br>";
        echo "---";
        echo "<br>";
        echo $row["comment"];
        echo "<br>";
        echo "-------------------------------------------------------------------";
        echo "<br>";
        echo "<br>";
    }
?>