<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Feed Item</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




<!-- Include Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>






    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="mb-4">Add New Feed Item</h2>
            <form action="updateFeed.php" method="post">
                <!-- Form fields for all nodes in the item element -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>



                <div class="mb-3">
                    <label for="imageSrc" class="form-label">Image Source:</label>
                    <input type="text" class="form-control" id="imageSrc" name="imageSrc" required>
                </div>
                //ok

                <div class="mb-3">
    <label for="pubDate" class="form-label">Publication Date:</label>
    <input type="text" class="form-control" id="pubDate" name="pubDate" placeholder="Format: Fri, 18 Aug 2023 00:00:00 GMT" required>
</div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <select class="form-select" id="author" name="author" required>
                        <option value="" disabled selected>Select Author</option>
                        <option value="bryce@scpolicycouncil.org (Bryce Fiedler)">Bryce Fiedler</option>
                        <option value="sam@scpolicycouncil.org (Sam Aaron)">Sam Aaron</option>
                    </select>
                </div>

               


                <div class="mb-3">
    <label for="category" class="form-label">Category:</label>
    <!-- Include the category dropdown -->
    <?php include 'category-dropdown.php'; echo generateCategoryDropdown(); ?>
</div>




                <!-- Input field for new category (visible when "Add New Category" is selected) -->
                <div class="mb-3" id="newCategoryInput" style="display: none;">
                    <label for="newCategory" class="form-label">New Category:</label>
                    <input type="text" class="form-control" id="newCategory" name="newCategory">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <script>




        // Show/hide newCategoryInput based on category selection
        $('#category').change(function () {
            if ($(this).val() === 'other') {
                $('#newCategoryInput').show();
            } else {
                $('#newCategoryInput').hide();
            }
        });


    // Initialize Bootstrap Datepicker
    $(document).ready(function () {
        $('#pubDate').datepicker({
            format: 'D, dd M yyyy 00:00:00 GMT',
            autoclose: true,
            todayHighlight: true
        });
    });




    document.addEventListener('DOMContentLoaded', function() {
    // Initialize flatpickr for the pubDate input
    flatpickr('#pubDate', {
        enableTime: true,
        dateFormat: 'D, d M Y H:i:S \G\M\T',
        defaultDate: 'today',
        placeholder: 'Format: Fri, 18 Aug 2023 00:00:00 GMT',
    });
});

    

    </script>

</body>

</html>
