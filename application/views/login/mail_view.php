<table class="table">
    <?php
        $i = 1; 
        echo "<tr>";        
        echo "<td>Username</td>"; 
        echo "<td>Password</td>";             
        echo "<tr>"; 
            
        foreach($records as $r) {
            echo "<tr>";  
            echo "<td>".$r->emp_id."</td>"; 
            echo "<td>".$r->password."</td>"; 
            echo "<tr>"; 
        } 
    ?>
</table>