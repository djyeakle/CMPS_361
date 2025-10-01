<!DOCTYPE html>
<html lang="en";>
    <head>
        <title>GridView</title>
        <link rel="stylesheet" href="./styles.css">
        <!--<script src="./searchTable.js"></script>-->
    </head>
    <body>

<?php

$apiURL = "http://localhost:8008/api/login";

//fetch the data
$response = file_get_contents($apiURL);
//decode json
$data = json_decode($response, true);

//validate the data exists
if ($data && is_array($data)) {
    $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

    if ($search) {
        $data = array_filter($data, function($row) use ($search) {
            return (
                strpos(strtolower($row['accountID']), $search) !== false ||
                strpos(strtolower($row['username']), $search) !== false ||
                strpos(strtolower($row['password']), $search) !== false
            );
        });
    }


    //pagination
    $limit = 10;
    $totalRecords = count($data);
    $totalPages = max(1, ceil($totalRecords / $limit));

    //capture the current page or set a default page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //calculate the starting index of the current page
    if ($currentPage < 1) {
        $currentPage = 1;
    } else if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    $sortColumn = isset($_GET['sort']) ? $_GET["sort"] : 'accountID';
    $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc';

    usort($data,function($a, $b) use ($sortColumn, $sortOrder) {
        if ($sortOrder == 'asc') {
            return strcmp($a[$sortColumn], $b[$sortColumn]);
        } else {
            return strcmp($b[$sortColumn], $a[$sortColumn]);
        }
    });

    $startIndex = ($currentPage - 1) * $limit;
    $pageData = array_slice($data, $startIndex, $limit);

    function toggleOrder($currentOrder) {
        return $currentOrder == 'asc' ? 'desc' : 'asc';
    }

    //search box
    echo "<div class='search-container'>";
    echo "<form method='get' action=''>";
    echo "<label for='searchInput'>Search: </label>";
    echo "<input type='text' id='searchInput' name='search' value='" . htmlspecialchars($search) . "'>";
    echo "<button type='submit'>Search</button>";
    echo "</form>";
    echo "</div>";

    //build out the table
    //echo "<table border='1' cellpaddiing='10'>";
    echo "<table id='dataGrid'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><a href='?page=$currentPage&sort=accountID&order=" . toggleOrder($sortOrder) . "$search=$search'>accountID</a></th>";
    echo "<th><a href='?page=$currentPage&sort=username&order=" . toggleOrder($sortOrder) . "$search=$search'>username</a></th>";
    echo "<th><a href='?page=$currentPage&sort=password&order=" . toggleOrder($sortOrder) . "$search=$search'>password</a></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    if ($pageData) {
        foreach ($pageData as $post) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($post['accountID']) . "</td>";
            echo "<td>" . htmlspecialchars($post['username']) . "</td>";
            echo "<td>" . htmlspecialchars($post['password']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No results found.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<div style='margin-top: 20px;'>";
    //display previous link if not on first page
    if ($currentPage > 1) {
        echo "<a href='?page=" . ($currentPage - 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '$search=' . $search . "'>Previous </a>";
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<strong>$i</strong>";
        } else {
            echo "<a href='?page=" . $i . '&sort=' . $sortColumn . '&order=' . $sortOrder . '$search=' . $search . "'>" . $i . "</a>";
        }
    }

    if ($currentPage < $totalPages) {
        echo "<a href='?page=" . ($currentPage + 1) . '&sort=' . $sortColumn . '&order=' . $sortOrder . '$search=' . $search . "'> Next</a>";
    }
    echo "</div>";

} else {
    echo "Sorry no data is available, see you tomorrow.";
}

?>

    </body>
</html>