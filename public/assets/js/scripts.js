 // Snackbar
 var showAlert = function(type, body, title = null) {
    function getBackgroundColor() {
        switch (type) {
            case 'success':
                return '#28a745';
                break;

            case 'info':
                return '#007bff';
                break;

            case 'danger':
                return '#dc3545';
                break;

            default:
                return '#323232';
                break;
        }
    }
    Snackbar.show({
        text: body
        , pos: 'bottom-right'
        , backgroundColor: getBackgroundColor(),
        actionTextColor: type == 'default' ? '#4CAF50' : '#ffc107'
    });
}