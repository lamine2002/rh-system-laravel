document.addEventListener('DOMContentLoaded', function() {

const member = document.getElementById('planning_staff_id');
const team = document.getElementById('planning_team_id');

member.addEventListener('change', function() {
    if (member.value) {
        // Disable the team select
        team.setAttribute('disabled', 'disabled');
    }else {
        // Enable the team select
        team.removeAttribute('disabled');
    }
});

team.addEventListener('change', function() {
    if (team.value) {
        // Disable the member select
        member.setAttribute('disabled', 'disabled');
    }else {
        // Enable the member select
        member.removeAttribute('disabled');
    }
});

});
