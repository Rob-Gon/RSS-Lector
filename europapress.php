<?php

    // We load the XML file of the news feed
    $rss = new DOMDocument();
    $rss->load('https://www.europapress.es/rss/rss.aspx?ch=00066');

    // We get the elements from the news source
    $news = $rss->getElementsByTagName("item");
    $output = array();

    // We scroll through the elements of the news feed
    foreach ($news as $newsItem) 
    {
        $content = array();
        $content["title"] = $newsItem->getElementsByTagName("title")[0]->nodeValue;
        $content["description"] = $newsItem->getElementsByTagName("description")[0]->nodeValue;
        $content["link"] = $newsItem->getElementsByTagName("link")[0]->nodeValue;
        $content["imagen"] = $newsItem->getElementsByTagName("enclosure")[0]->getAttribute("url");
        $output[] = $content;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Roberto González">
    <meta name="description" content="RSS Lector">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuropaPress News</title>
    <style>
        h2 {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-color: #007bff;
            text-underline-offset: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4 mb-4">EuropaPress News</h2>
    <!-- We show the news in a table -->
    <table class="table table-striped">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">News</th>
                <th scope="col">Description</th>
                <th scope="col">Link</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($output as $news): ?>
                <tr>
                    <td><?php echo $news["title"]; ?></td>
                    <td><?php echo $news["description"]; ?></td>
                    <td><a href="<?php echo $news["link"]; ?>" target="_blank">Open Link</a></td>
                    <td><img src="<?php echo $news["imagen"]; ?>" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
