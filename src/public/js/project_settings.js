
/*settings*/

let deleteRequestBtn = document.querySelectorAll("section.container-fluid div.content_view div.option_buttons a.request_delete");
let acceptRequestBtn = document.querySelectorAll("section.container-fluid div.content_view div.option_buttons a.request_accept");

let promoteMemberBtn = document.querySelectorAll("section.container-fluid div#members div.member div.buttons a.promote");
let removeMemberBtn = document.querySelectorAll("section.container-fluid div#members div.member div.buttons a.remove");

let settingsRequestsBtn = document.querySelector("li.nav-item a#requests");
let settingsMembersBtn = document.querySelector("li.nav-item a#members");

function addEventListenersSettings() {


    let promoteMemberBtn = document.querySelectorAll("section.container-fluid div#members div.member-row div.buttons a.promote");
    let removeMemberBtn = document.querySelectorAll("section.container-fluid div#members div.member-row div.buttons a.remove");

    settingsRequestsBtn.addEventListener('click', switchRequestView);
    settingsMembersBtn.addEventListener('click', switchMembersView);

    for (let i = 0; i < deleteRequestBtn.length; i++) {
        deleteRequestBtn[i].addEventListener('click', deleteRequest);
    }

    for (let i = 0; i < acceptRequestBtn.length; i++) {
        acceptRequestBtn[i].addEventListener('click', acceptRequest);
    }

    for (let i = 0; i < promoteMemberBtn.length; i++) {
        promoteMemberBtn[i].addEventListener('click', promoteMember);
    }

    for (let i = 0; i < removeMemberBtn.length; i++) {
        removeMemberBtn[i].addEventListener('click', removeMember);
    }

}

function switchRequestView(event) {
    event.preventDefault();

    settingsRequestsBtn.classList.add('active');
    settingsMembersBtn.classList.remove('active');

    sendAjaxRequest('get', event.target.href, null, showSettingsView);
}

function switchMembersView(event) {
    event.preventDefault();

    settingsMembersBtn.classList.add('active');
    settingsRequestsBtn.classList.remove('active');

    sendAjaxRequest('get', event.target.href, null, showSettingsView);
}

function showSettingsView() {

    let data = JSON.parse(this.responseText);

    let content = document.querySelector("section.container-fluid div.content_view");
    content.innerHTML = data.html;

    addEventListenersSettings();
}

function deleteRequest(event) {
    event.preventDefault();

    let index = event.target.href.indexOf('projects');
    let index2 = event.target.href.indexOf('settings');
    let project_id = event.target.href.substring(index + 9, index2 - 1);
    index = event.target.href.indexOf('requests');
    let request_id = event.target.href.substring(index + 9, event.target.href.length - 7);

    swal({
        title: "Are you sure you want to reject this request?\n",
        text: "Once deleted, you will not be able to recover this request!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                sendAjaxRequest('post', event.target.href, { project_id: project_id, request_id: request_id }, updateRequests);
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your request is safe!");
            }
        });
}

function acceptRequest(event) {
    event.preventDefault();

    let index = event.target.href.indexOf('projects');
    let index2 = event.target.href.indexOf('settings');
    let project_id = event.target.href.substring(index + 9, index2 - 1);
    index = event.target.href.indexOf('requests');
    let request_id = event.target.href.substring(index + 9, event.target.href.length - 7);

    swal({
        title: "Are you sure you want to accept this request?\n",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                sendAjaxRequest('post', event.target.href, { project_id: project_id, request_id: request_id}, updateRequests);
                swal("Your request has been accepted !", {
                    icon: "success",
                });
            } else {
                swal("Your request is safe!");
            }
        });
}

function updateRequests() {

    let data = JSON.parse(this.responseText);
    if (data.success) {
        let request = document.querySelector("div.request[data-id='" + data.request_id + "']");
        request.remove();
    }
}

function promoteMember(event) {
    event.preventDefault();

    let index = event.target.href.indexOf('projects');
    let index2 = event.target.href.indexOf('settings');
    let project_id = event.target.href.substring(index + 9, index2 - 1);
    index = event.target.href.indexOf('members');
    let member_username = event.target.href.substring(index + 8, event.target.href.length-8);

    swal({
        title: "Are you sure you want to promote this member to Coordenator?\n",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                sendAjaxRequest('post', event.target.href, { project_id: project_id, username: member_username }, promotedMemberUpdate);
            }
        });
}

function promotedMemberUpdate() {
    let data = JSON.parse(this.responseText);
    if (data.success) {
        let button = document.querySelector("div.member[data-id='" + data.member_username + "'] div.buttons a");
        button.remove();
        swal("The Team Member has been promoted to Coordinator!", {
            icon: "success",
        });
    }
}

function removeMember(event) {
    event.preventDefault();

    let index = event.target.href.indexOf('projects');
    let index2 = event.target.href.indexOf('settings');
    let project_id = event.target.href.substring(index + 9, index2 - 1);
    index = event.target.href.indexOf('members');
    let member_username = event.target.href.substring(index + 8, event.target.href.length-7);

    swal({
        title: "Are you sure you want to remove this member from the project?\n",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                sendAjaxRequest('post', event.target.href, { project_id: project_id, username: member_username }, removeMemberUpdate);
            }
        });
}

function removeMemberUpdate() {
    let data = JSON.parse(this.responseText);
    if (data.success) {
        let div = document.querySelector("div.member[data-id='" + data.member_username + "']");
        div.remove();
        swal("The user has been removed from the project!", {
            icon: "success",
        });
    }
}

addEventListenersSettings();