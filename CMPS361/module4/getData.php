<?php
    $apiURL = "http://localhost:8003/api/v1/nepalSupermarket";

    // Fetch the data
    $response = file_get_contents($apiURL);

    // Decode JSON
    $data = json_decode($response, true);

    // Validate if data exists
    if($data && is_array($data)) {
        // pagination
        $limit = 10; //number of records per pgae
        $totalRecords = count($data); //Total number of records
        $totalPages = ceil($totalRecords / $limit); //calc number of pages

        // Get the current page or set a defualt page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Ensure the current page is within valid range
        if ($currentPage <1) {
            $currentPage = 1;
        } elseif($currentpage > $totalPages) {
            $currentPage = $totalPages;
        }

        $startIndex = ($currentPage - 1) * $limit;
        $pageData = array_slice($data, $startIndex, $limit);

        // Build out the table
        echo "<table border = '1' cellpadding = '10'>";
        echo "<thread>";
        // creating table row (<tr>)
        echo "<tr>";
        echo "<th> Product ID </th>";
        echo "<th> Product Name </th>";
        echo "<th> Category </th>";
        echo "</tr>";
        echo "</thread>";

        // creating table body (<tbody>)
        echo "<tbody>";

        // loop through the data
        foreach ($pageData as $post) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($post['id']) . "</td>";
            echo "<td>" . htmlspecialchars($post['name']) . "</td>";
            echo "<td>" . htmlspecialchars($post['category']) . "</td>";
        }
        echo "</tbody>";
        echo "</table>";

        echo "<div style = 'margin-top: 20px; display: flex; gap: 10px;'>";
        // Display previous link if not on first page
        if ($currentPage > 1) {
            echo '<a href=?page=' . ($currentPage - 1) . '">Previous</a> '; 
        }

        // Display page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo "<strong>$i</strong>";
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }

        //Next Page
        if ($currentPage < $totalPages) {
            echo '<a href=?page=' . ($currentPage + 1) . '">Next</a>';
        }
        echo "</div>";


    } else {
        echo "Sorry no data is available, see you tomorrow :)";
    }
    
?>