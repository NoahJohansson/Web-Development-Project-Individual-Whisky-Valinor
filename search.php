<?php

    $db = new SQLITE3 ('./db/sqlite.db');

    $search = SQLite3::escapeString($_POST['search']);//Prevent sql injection
        $res = $db->query("SELECT * FROM Posts WHERE comment LIKE '%$search%' OR email LIKE '%$search%' ORDER BY ID desc"); //Select rows from database where email or comment contains $search
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