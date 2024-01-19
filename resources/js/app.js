import './bootstrap';
import './data';
import 'remixicon/fonts/remixicon.css';
import LazyLoad from 'vanilla-lazyload';

import {
    isExist,
    addEventListener,
    previewImageUpload,
    showHideDialog,
    removeAllStyle,
    search
} from "./utilities";

const loader = document.querySelector('.loader');

if (isExist(loader)) {
    document.body.style.overflowY = 'hidden';
    loader.classList.add('show');
}

window.addEventListener('load', () => {
    document.body.style.overflowY = 'auto';
    loader.classList.remove('show');
})

window.addEventListener('DOMContentLoaded', () => {
    var lazyloadInstance = new LazyLoad();
    lazyloadInstance.update();

    const showProfileBtn = document.querySelector('.show-profile'),
        profileWrapper = document.querySelector('.profile');
    
    addEventListener(showProfileBtn, 'click', (e) => {
        e.stopPropagation();
        profileWrapper.classList.remove('hidden');
    })

    addEventListener(profileWrapper, 'click', (e) => {
        e.stopPropagation();
    })

    const showNotificationBtn = document.querySelector('.show-notification'),
        hideNotificationBtn = document.querySelector('.hide-notification'),
        notificationWrapper = document.querySelector('.notification');
    
    addEventListener(showNotificationBtn, 'click', (e) => {
        e.stopPropagation();
        notificationWrapper.classList.add('show');
    })

    addEventListener(hideNotificationBtn, 'click', (e) => {
        notificationWrapper.classList.remove('show');
    })

    addEventListener(notificationWrapper, 'click', (e) => {
        e.stopPropagation();
    })

    const showSnapOptionBtns = document.querySelectorAll('.show-snap-option'),
        snapOptionWrappers = document.querySelectorAll('.snap-options'),
        deletSnapBtn = document.querySelectorAll('.delete-snap'),
        deleteSnapDialog = document.getElementById('delete-snap-dialog');
    
    showSnapOptionBtns.forEach((showSnapOptionBtn, index) => {
        addEventListener(showSnapOptionBtn, 'click', (e) => {
            e.stopPropagation();
            snapOptionWrappers.forEach(snapOptionWrapper => snapOptionWrapper.classList.add('hidden'));
            snapOptionWrappers[index].classList.remove('hidden');
        })
    })
    
    snapOptionWrappers.forEach(snapOptionWrapper => {
        addEventListener(snapOptionWrapper, 'click', (e) => e.stopPropagation());
    })

    deletSnapBtn.forEach(deletSnapBtn => {
        addEventListener(deletSnapBtn, 'click', ({ target }) => {
            showHideDialog(deleteSnapDialog, target.dataset.id);
        })
    })

    const commentTxtInput = document.querySelector('.comment-input'),
        postCommentBtn = document.querySelector('.post-comment');
    
    addEventListener(commentTxtInput, 'keyup', ({ target }) => {
        if (target.value.length < 1) {
            postCommentBtn.classList.add('hidden');
            return
        }
        postCommentBtn.classList.remove('hidden');
    })

    const deletePageBtn = document.getElementById('delete-page'),
        deletePageDialog = document.getElementById('delete-page-dialog');
    
    addEventListener(deletePageBtn, 'click', ({ target }) => {
        showHideDialog(deletePageDialog, target.dataset.id);
    })

    const closeDialogs = document.querySelectorAll('.close-dialog');

    closeDialogs.forEach(closeDialog => {
        addEventListener(closeDialog, 'click', ({ target }) => {
            const targetDialog = document.querySelector(target.dataset.target);
            showHideDialog(targetDialog, "");
        })
    })
    
    const uploadContainers = document.querySelectorAll('.upload-container');
    
    uploadContainers.forEach(uploadContainer => {
        addEventListener(uploadContainer, 'click', () => {
            const uploadInput = uploadContainer.querySelector('.file-upload');
            uploadInput.click();
        })
    })
    
    const uploadInputs = document.querySelectorAll('.file-upload');
    uploadInputs.forEach(uploadInput => {
        addEventListener(uploadInput, 'change', (e) => {
            previewImageUpload(e);
        })
    })
    
    const tickboxes = document.querySelectorAll('.tickbox');
    
    tickboxes.forEach(tickbox => {
        addEventListener(tickbox, 'click', ({ currentTarget }) => {
            const divWrapper = currentTarget.parentNode,
                tickInput = divWrapper.querySelector('input'),
                childTickboxes = divWrapper.querySelectorAll('.tickbox');
            
            childTickboxes.forEach(childTickbox => childTickbox.classList.remove('active'));
            tickbox.classList.add('active');
            tickInput.value = currentTarget.dataset.value;
        })
    })

    const tabs = document.querySelectorAll('.tab'),
        tabItems = document.querySelectorAll('.tab-item');
    
    tabs.forEach((tab, index) => {
        addEventListener(tab, 'click', () => {
            removeAllStyle(tabs, 'active');
            removeAllStyle(tabItems, 'active');
            tab.classList.add('active');
            tabItems[index].classList.add('active');
        })
    })

    const editInfoBtn = document.getElementById('edit-information'),
        saveInfoBtn = document.getElementById('save-information'),
        disabledInputs = document.querySelectorAll('.disabled-input');
    
    addEventListener(editInfoBtn, 'click', () => {
        editInfoBtn.classList.add('hidden');
        saveInfoBtn.classList.remove('hidden');
        disabledInputs.forEach(disabledInput => disabledInput.removeAttribute('disabled'));
    });

    const searchInputs = document.querySelectorAll('.search-input');

    searchInputs.forEach(searchInput => {
        addEventListener(searchInput, 'keyup', ({ target }) => {
            search(target.value);
        })
    })
    
    const documentBody = document.body;
    addEventListener(documentBody, 'click', () => {
        if (isExist(snapOptionWrappers)) {
            snapOptionWrappers.forEach(snapOptionWrapper => snapOptionWrapper.classList.add('hidden'));
        }

        if (isExist(profileWrapper)) {
            profileWrapper.classList.add('hidden');
        }

        if (isExist(notificationWrapper)) {
            notificationWrapper.classList.remove('show');
        }
    })
})
