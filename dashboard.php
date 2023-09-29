<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSS Feed Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Include Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
</head>
<body class="container mt-5" style="background-color: #FFFFFG; ">

    <!-- Header -->
    <header class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SCPC RSS Feed Dashboard</a>
            <!-- Add a responsive navigation button for mobile view -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </header>

    <div class="row">
        <!-- Left Column (20%) -->
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Actions</h5>
                    <button class="btn btn-info btn-block mb-3" onclick="loadFeed()">Home</button>
                    <button class="btn btn-primary btn-block mb-2" onclick="loadContent('add')">Add New Feed Item</button>
                    <button class="btn btn-success btn-block mb-2" onclick="loadContent('update')">Update Feed Item</button>
                    <button class="btn btn-danger btn-block mb-2" onclick="loadContent('delete')">Delete Feed Item</button>
                    
                </div>
            </div>
        </div>

        <!-- Right Column (80%) -->
        <div class="col-12 col-md-9">
         

             <!-- Filter section -->
<!-- Filter section -->
<!-- Filter section -->
<div id="filterSection" class="card-body">
    <h5 class="card-title">Filter by Category</h5>
    <?php include 'category-filter.php'; echo generateCategoryFilter(); ?>
</div>


            <div id="content">
                <!-- Content will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>






        // Function to parse XML and display content
        function parseXML(xml) {
            var categoryFilter = $('#categoryFilter').val();
            var content = '';

            $(xml).find('item').each(function () {
                var title = $(this).find('title').text();
                var link = $(this).find('link').text();
                var description = $(this).find('description').text();
                var pubDate = $(this).find('pubDate').text();
                var category = $(this).find('category').text();
                var author = $(this).find('author').text();

                // Use pure JavaScript to extract img source from CDATA
                var contentEncoded = $(this).find('content\\:encoded').text();
                var imgSrcMatches = contentEncoded.match(/<img[^>]+src\s*=\s*['"]([^'"]+)['"]/);
                var imgSrc = imgSrcMatches ? imgSrcMatches[1] : '';

                // Check if the item matches the selected category or if no category is selected
                if (categoryFilter === '' || categoryFilter === category) {
                    content += '<div class="card mb-4">';
                    content += '<img src="' + imgSrc + '" class="card-img-top" alt="' + title + '">';
                    content += '<div class="card-body">';
                    content += '<span class="badge bg-info">' + category + '</span>'; // Category tag
                    content += '<h3 class="card-title"><a href="' + link + '" target="_blank">' + title + '</a></h3>';
                    content += '<p class="card-text">' + description + '</p>';
                    content += '<ul class="list-group list-group-flush">';
                    content += '<li class="list-group-item"><strong>Author:</strong> ' + author + '</li>';
                    content += '<li class="list-group-item"><strong>Published Date:</strong> ' + pubDate + '</li>';
                    // Add other item details as needed
                    content += '</ul>';
                    content += '</div></div>';
                }
            });

            // Display the content
            $('#content').html(content);
        }

    

// Function to load content based on action
function loadContent(action) {

     
            // Hide the filter section
            $('#filterSection').hide();


            if (action === 'add') {
                // Load add.php when Add New Feed Item is clicked
                $.ajax({
                    type: 'GET',
                    url: 'add.php',
                    success: function (html) {
                        // Display the content
                        $('#content').html(html);
                    },
                    error: function () {
                        // Handle error if the file couldn't be loaded
                        $('#content').html('<p>Error loading content.</p>');
                    }
                });
            } else {
                // Your logic to load content based on other actions
                // (Existing logic remains unchanged)
                $('#content').html('<p>' + action + ' content will be displayed here.</p>');
            }
        }











        // Function to filter content by category
        function filterByCategory() {
            // Reload the RSS feed and apply category filter
            loadFeed();
        }

        // Function to handle errors during RSS feed loading
        function handleFeedError(xhr, status, error) {
            $('#content').html('<p>Error loading RSS feed. Status: ' + status + ', Error: ' + error + '</p>');
        }

        // Function to load RSS feed
        function loadFeed() {
            // Show the filter section
            $('#filterSection').show();

            $.ajax({
                type: 'GET',
                url: 'scpc-feed.xml',
                dataType: 'xml',
                success: function (xml) {
                    // Parse XML and display content
                    parseXML(xml);
                },
                error: handleFeedError
            });
        }

        // Load content automatically when the dashboard loads
        $(document).ready(function () {
            loadFeed();
        });






          // Initialize the datepicker
          $('.datepicker').datepicker({
            format: 'D, dd M yyyy hh:ii:ss UTC',
            autoclose: true,
        });

    </script>

</body>
</html>
