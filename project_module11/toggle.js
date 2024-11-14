
// function for sorting and searching by ID, username or full_name.
function applySearchSort() {
    const sortBy = document.getElementById('sort-by').value;
    const searchQuery = document.getElementById('search-query').value;

    const url = new URL(window.location.href);
    url.searchParams.set('sort_by', sortBy);
    url.searchParams.set('search_query', searchQuery);

    window.location.href = url.toString();
}            

function goButton(adminId) {
    // Get the selected action from the dropdown
    const selectElement = document.getElementById(`action-${adminId}`);
    const selectedAction = selectElement.value;

    // Check if an action is selected
    if (selectedAction) {
        // Construct the URL with the selected action and admin ID
        const url = `${selectedAction}.php?id=${adminId}`;
        // Redirect to the constructed URL
        window.location.href = url;
    } else {
        alert("Please select an action first.");
    }
}