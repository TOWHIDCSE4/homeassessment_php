$(document).ready(function() {
    // Define the base URL for the API
    var baseUrl = api_base_url; //'http://localhost:8000/api/'
        
    // Fetch posts on page load
    fetchPosts();

    // Handle form submission
    $('#postForm').submit(function(e) {
        e.preventDefault();
        var title = $('#title').val();
        var body = $('#body').val();
        submitPost(title, body);
    });

    function fetchPosts() {
        // Make GET request to fetch posts
        $.get(baseUrl + 'blogs', function(data) {
            var postsHTML = '';
            data.forEach(function(post) {
                postsHTML += '<div class="post">';
                postsHTML += '<h2>' + post.title + '</h2>';
                postsHTML += '<p>' + post.body + '</p>';
                postsHTML += '</div>';
            });
            $('#posts').html(postsHTML);
        });
    }

    function submitPost(title, body) {
        // Make POST request to submit a new post
        $.post(baseUrl + 'blogs', {title: title, body: body}, function() {
            // Refresh posts after submission
            fetchPosts();
            // Clear form fields
            $('#title').val('');
            $('#body').val('');
        });
    }
});
