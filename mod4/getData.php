<?php

$apiURL = "http://localhost:8008/api/login";

//fetch the data
$response = file_get_contents($apiURL);
//decode json
$data = json_decode($response, true);

//validate the data exists
if ($data && is_array($data)) {
    //pagination
    $limit = 10;
    $totalRecords = count($data);
    $totalPages = ceil($totalRecords / $limit);

    //capture the current page or set a default page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //calculate the starting index of the current page
    if ($currentPage < 1) {
        $currentPage = 1;
    } else if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    $startIndex = ($currentPage - 1) * $limit;
    $pageData = array_slice($data, $startIndex, $limit);
    //build out the table
    echo "<table border='1' cellpaddiing='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>accountID</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    //loop through the data
    foreach ($pageData as $post) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['accountID']) . "</td>";
        echo "<td>" . htmlspecialchars($post['username']) . "</td>";
        echo "<td>" . htmlspecialchars($post['password']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<div style='margin-top: 20px;'>";
    //display previous link if not on first page
    if ($currentPage > 1) {
        echo "<a href='?page" . ($currentPage - 1) . "'>Previous </a>";
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<strong>$i</strong>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }

    if ($currentPage < $totalPages) {
        echo "<a href='?page=" . ($currentPage - 1) . "'> Next</a>";
    }
    echo "</div>";

} else {
    echo "Sorry no data is available, see you tomorrow.";
}

?>