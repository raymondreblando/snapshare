export async function request(url, onSuccess, options = {}) {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  const defaultOptions = {
    method: "POST",
    body: null,
    type: null,
    headers: {
      'X-CSRF-TOKEN': csrf,
      'Accept': 'application/json',
    },
  };

  const { method, body, type, headers } = { ...defaultOptions, ...options };

  try {
    const response = await fetch(url, { method, body, headers });

    if (!response.ok) {
      toast('error', 'An error occur. Try again');
    }

    // const responseData = await response.text();
    // console.log(responseData)

    if (type === 'react') return

    const responseData = await response.json();

    if (responseData.hasOwnProperty('errors')) {
      return toast('error', responseData.message);
    }

    toast('success', responseData.message);
    onSuccess();
  } catch (error) {
    toast('error', error.message);
  }
}

export function isExist (element) {
  return Array.isArray(element) ? element.length !== 0 : element !== null;
}

export function addEventListener (element, type = 'click', callback) {
  if (!isExist(element)) return
  element.addEventListener(type, callback);
}

export function toast(type, message) {
  const toast = document.querySelector('.toast'),
    toastMessage = document.querySelector('.toast-message');
  
  toastMessage.textContent = message;
  toast.classList.add(type);

  setTimeout(() => {
    toast.classList.remove(type);
  }, 1000);
}

export function previewImageUpload(e) {
  const parentElement = e.target.parentNode,
        imagePreview = parentElement.querySelector('.image-preview'),
        uploadIcon = parentElement.querySelector('.upload-icon');
    
    const fileReader = new FileReader();

    fileReader.onload = (e) => {
        uploadIcon.classList.add('hidden');
        imagePreview.removeAttribute('hidden');
        imagePreview.src = e.target.result;
    }

    fileReader.readAsDataURL(e.target.files[0]);
}

export function showHideDialog(element, id) {
  const confirmBtn = element.querySelector('.confirm-btn');
  confirmBtn.setAttribute('data-id', id);
  element.classList.toggle('hidden');
}

export function removeAllStyle(nodes, style) {
  if (!isExist(nodes)) return
  nodes.forEach(node => node.classList.remove(style));
}

export function search(value){
  const searchAreas = document.querySelectorAll('.search-area');
  const matcher = new RegExp(value, 'i');

  searchAreas.forEach(searchArea => {
    const finders = searchArea.querySelectorAll('.finder1, .finder2, .finder3, .finder4, .finder5, .finder6');
    let shouldHide = true;

    finders.forEach(finder => {
      if (matcher.test(finder.textContent)) {
        searchArea.classList.add("search-match");
        shouldHide = false;
      }
    });

    if (shouldHide) {
      searchArea.classList.remove("search-match");
      searchArea.style.display = 'none';
    } else {
       searchArea.style.display = 'flex';
    }
  });
}

export function react(reactBtn) {
  reactBtn.classList.toggle('active');
  const count = reactBtn.querySelector('.count');
  count.textContent = reactBtn.classList.contains('active')
      ? parseInt(count.textContent) + 1
      : parseInt(count.textContent) - 1;
}

export function saveSnap() {
  const saveSnaps = document.querySelectorAll('.save-snap');

  saveSnaps.forEach(saveSnap => {
      addEventListener(saveSnap, 'click', () => {
          const snapId = saveSnap.dataset.id;
          let formData = new FormData();
          formData.append('snap_id', snapId);

          request('/save', () => {
            saveSnap.classList.remove('save-snap');
            saveSnap.classList.add('unsave-snap'); 
            deletSaveSnap();
          }, {
              body: formData
          })
      });
  })
}

export function deletSaveSnap() {
  const unsaveSnaps = document.querySelectorAll('.unsave-snap');

  unsaveSnaps.forEach(unsaveSnap => {
      addEventListener(unsaveSnap, 'click', () => {
          const snapId = unsaveSnap.dataset.id;
          let formData = new FormData();
          formData.append('_method', 'delete');

          request(`/save/${snapId}`, () => {
            unsaveSnap.classList.remove('unsave-snap');
            unsaveSnap.classList.add('save-snap');
            saveSnap();
          }, {
              body: formData
          })
      });
  })
}