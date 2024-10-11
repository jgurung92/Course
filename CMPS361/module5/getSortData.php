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

// Sorting logic
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default sort by 'id'
$sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc'; // Default order is 'asc'

// Sort the data based on column and order
usort($data, function($a, $b) use ($sortColumn, $sortOrder) {
    // Handle numeric comparison for IDs
    if (is_numeric($a[$sortColumn]) && is_numeric($b[$sortColumn])) {
        return $sortOrder === 'asc' ? $a[$sortColumn] - $b[$sortColumn] : $b[$sortColumn] - $a[$sortColumn];
    }
    
    // Handle string comparison for other columns
    return $sortOrder === 'asc' ? strcmp($a[$sortColumn], $b[$sortColumn]) : strcmp($b[$sortColumn], $a[$sortColumn]);
});

        // Calculate the starting index of the current page
        $startIndex = ($currentPage - 1) * $limit;

        // Get the subset of data for the current page
        $pageData = array_slice($data, $startIndex, $limit);

        // Function to toggle sort order
        function toggleOrder($currentOrder) {
            return $currentOrder == 'asc' ? 'desc' : 'asc';
        }

        // Display data in a GridView (HTML Table)
        echo "<table border = '1' cellpadding = '10'> ";
        echo "<thead>";
        echo "<tr>";
        echo "<th><a href='?page=$currentPage&sort=id&order=" . toggleOrder($sortOrder) . "'>Product ID</a></th>";
        echo "<th><a href='?page=$currentPage&sort=name&order=" . toggleOrder($sortOrder) . "'>Product Name</a></th>";
        echo "<th><a href='?page=$currentPage&sort=category&order=" . toggleOrder($sortOrder) . "'>Category</a></th>";
        echo "</tr>";
        echo "</thead>";
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
            echo '<a href=?page=' . ($currentPage - 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '">Previous</a> '; 
        }

        // Display page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo "<strong>$i</strong>";
            } else {
                echo '<a href="?page=' . $i .  '&sort=' . $sortColumn . '&order=' . $sortOrder . '">' . $i . '</a>';
            }
        }

        //Display next link if not the last page
        if ($currentPage < $totalPages) {
            echo '<a href=?page=' . ($currentPage + 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '">Next</a>';
        }
        echo "</div>";

        // Display total number of records at the bottom
        echo "<div style='margin-top: 20px; '>";
        echo "<strong> Total Records: $totalRecords</strong>";
        echo "</div>";
    } else {
        echo "Sorry no data is available see you tomorrow :)";
    }
    
?>