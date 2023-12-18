<?php

// Path file CSV
$file_path = 'data/rekomen.csv';

// Membaca file CSV ke dalam array dengan menggunakan delimiter "|"
$csv_data = array_map(function ($row) {
    return str_getcsv($row, '|');
}, file($file_path));

// Menghapus baris header
$header = array_shift($csv_data);

// Menentukan indeks kolom "average_rating" dan "Year-Of-Publication"
$averageRatingIndex = array_search('score', $header);
$yearOfPublicationIndex = array_search('Year-Of-Publication', $header);
$isbnIndex = array_search('ISBN', $header);
$rowKeyIndex = array_search('row_key', $header);

// Fungsi untuk membandingkan dua data berdasarkan average rating
// Fungsi untuk membandingkan dua data berdasarkan average rating
function compareByRating($a, $b)
{
    global $averageRatingIndex;

    // Memastikan kolom average_rating ada pada setiap baris
    if (isset($a[$averageRatingIndex]) && isset($b[$averageRatingIndex])) {
        // Membandingkan secara numerik
        $ratingA = (float) $a[$averageRatingIndex];
        $ratingB = (float) $b[$averageRatingIndex];

        return $ratingB <=> $ratingA;
    }

    return 0;
}


// Mengurutkan array berdasarkan average rating
usort($csv_data, 'compareByRating');

// Mengambil 4 baris pertama
$csv_data_subset = array_slice($csv_data, 0, 4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Viewer</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <?php foreach ($header as $col) : ?>
                <th><?php echo $col; ?></th>
            <?php endforeach; ?>
        </tr>

        <?php foreach ($csv_data_subset as $row) : ?>
            <tr>
                <?php foreach ($row as $index => $value) : ?>
                    <?php
                    $isNumeric = is_numeric($value);
                    $isISBN = $index === $isbnIndex || $index === $rowKeyIndex;
                    $isYear = $index === $yearOfPublicationIndex;
                    ?>
                    <td><?php echo ($isNumeric && !$isISBN && !$isYear) ? number_format((float) $value, 2) : $value; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>
