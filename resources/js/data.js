import {
    request,
    addEventListener,
    react,
    saveSnap,
    deletSaveSnap,
} from "./utilities";

const changeCoverPhotoBtn = document.getElementById('change-cover-photo'),
        coverPhotoForm = document.getElementById('cover-photo-form'),
        uploadCoverPhotoBtn = document.getElementById('upload-cover-photo'),
        coverPhotoUpload = document.getElementById('cover-photo');
        
addEventListener(coverPhotoForm, 'submit', (e) => {
    e.preventDefault();

    request('/cover-photo', () => {
        setTimeout(() => {
            location.reload();
        }, 500);
    }, {
        body: new FormData(e.target)
    });
});
    
addEventListener(changeCoverPhotoBtn, 'click', () => {
    coverPhotoUpload.click();
});

addEventListener(coverPhotoUpload, 'change', () => {
    uploadCoverPhotoBtn.click();
});

const changeProfilePicBtn = document.getElementById('change-profile'),
        profilePicForm = document.getElementById('profile-picture-form'),
        uploadProfilePicBtn = document.getElementById('upload-profile-picture'),
        profilePicUpload = document.getElementById('profile-picture');
        
addEventListener(profilePicForm, 'submit', (e) => {
    e.preventDefault();

    request('/avatar', () => {
        setTimeout(() => {
            location.reload();
        }, 500);
    }, {
        body: new FormData(e.target)
    });
});
    
addEventListener(changeProfilePicBtn, 'click', () => {
    profilePicUpload.click();
});

addEventListener(profilePicUpload, 'change', () => {
    uploadProfilePicBtn.click();
});

const heartBtns = document.querySelectorAll('.heart');

heartBtns.forEach(heartBtn => {
    addEventListener(heartBtn, 'click', () => {
        const snapId = heartBtn.dataset.id;
        let formData = new FormData();
        react(heartBtn);

        if (!heartBtn.classList.contains('active')) {
            formData.append('_method', 'delete');

            request(`/react/${snapId}`, () => {}, {
                body: formData,
                type: 'react'
            })

            return
        }

        formData.append('snap_id', snapId);

        request('/react', () => {}, {
            body: formData,
            type: 'react'
        })
    });
})



const deleteSnapForm = document.getElementById('delete-snap-form'),
    deleteSnapBtn = document.getElementById('confirm-delete-snap');

addEventListener(deleteSnapForm, 'submit', (e) => {
    e.preventDefault();
    const snapId = deleteSnapBtn.dataset.id;

    request(`/snap/${snapId}`, () => {
        setTimeout(() => {
            location.reload();
        }, 1100)
    }, {
        body: new FormData(e.target)
    })
})

const commentForm = document.querySelector('.comment-form'),
    postCommentBtn = document.querySelector('.post-comment');

addEventListener(commentForm, 'submit', (e) => {
    e.preventDefault();
    const snapId = postCommentBtn.dataset.id;
    let formData = new FormData(e.target);
    formData.append('snap_id', snapId);

    request('/comment', () => {
        commentForm.reset();

        setTimeout(() => {
            location.reload();
        }, 1100);
    }, {
        body: formData
    })
})

const deleteCommentBtns = document.querySelectorAll('.delete-comment');

deleteCommentBtns.forEach(deleteCommentBtn => {
    addEventListener(deleteCommentBtn, 'click', ({ target }) => {
        const commentId = target.dataset.id;
        let formData = new FormData();
        formData.append('_method', 'delete');

        request(`/comment/${commentId}`, () => {
            setTimeout(() => {
                location.reload();
            }, 100);
        }, {
            body: formData
        })
    });
})

const deletePageForm = document.getElementById('delete-page-form'),
    deletePageBtn = document.getElementById('confirm-delete-page');

addEventListener(deletePageForm, 'submit', (e) => {
    e.preventDefault();
    const pageId = deletePageBtn.dataset.id;

    request(`/page/${pageId}`, () => {
        setTimeout(() => {
            location.reload();
        }, 1100)
    }, {
        body: new FormData(e.target)
    })
})

const followBtns = document.querySelectorAll('.follow-btn');

followBtns.forEach(followBtn => {
addEventListener(followBtn, 'click', ({ target }) => {
    const followedId = target.dataset.id;
    let formData = new FormData();
    formData.append('followed_id', followedId);

    request('/follow', () => {
        location.reload();
    }, { body: formData })
})
})

const unfollowBtns = document.querySelectorAll('.unfollow-btn');

unfollowBtns.forEach(unfollowBtn => {
    addEventListener(unfollowBtn, 'click', ({ target }) => {
        const unfollowedId = target.dataset.id;
        let formData = new FormData();
        formData.append('_method', 'delete');

        request(`/follow/${unfollowedId}`, () => {
            location.reload();
        }, { body: formData })
    })
})

const followPageBtns = document.querySelectorAll('.follow-page');

followPageBtns.forEach(followPageBtn => {
addEventListener(followPageBtn, 'click', ({ target }) => {
    const pageId = target.dataset.id;
    let formData = new FormData();
    formData.append('page_id', pageId);

    request('/follow/page', () => {
        location.reload();
    }, { body: formData })
})
})

const unfollowPageBtns = document.querySelectorAll('.unfollow-page');

unfollowPageBtns.forEach(unfollowPageBtn => {
addEventListener(unfollowPageBtn, 'click', ({ target }) => {
    const pageId = target.dataset.id;
    let formData = new FormData();
    formData.append('_method', 'delete');
    formData.append('page_id', pageId);

    request(`/follow/page/${pageId}`, () => {
        location.reload();
    }, {  body: formData })
})
})

saveSnap();
deletSaveSnap();