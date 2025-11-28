@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-pink-500 to-purple-600 py-10 flex justify-center">
    <div class="w-full max-w-lg px-4">

        <h1 class="text-3xl text-white font-bold mb-6 text-center">Discover Profiles</h1>

        <!-- Card Area -->
        <div id="card-area" class="relative w-full max-w-md h-[520px] mx-auto flex items-center justify-center">
            <div id="no-more" class="hidden absolute inset-0 flex items-center justify-center text-white text-xl font-bold">
                No more profiles
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-center mt-8 gap-10">

            <button id="undoBtn" 
                class="w-14 h-14 rounded-full bg-yellow-400 text-black text-2xl shadow-xl active:scale-90">
                ⤺
            </button>

            <button id="dislikeBtn" 
                class="w-16 h-16 rounded-full bg-white shadow-xl border-4 border-red-500 
                       text-red-500 text-3xl flex items-center justify-center active:scale-90">
                ✖
            </button>

            <button id="superLikeBtn"
                class="w-14 h-14 rounded-full bg-blue-500 text-white text-2xl shadow-xl active:scale-90">
                🔷
            </button>

            <button id="likeBtn"
                class="w-16 h-16 rounded-full bg-white shadow-xl border-4 border-green-500 
                       text-green-500 text-3xl flex items-center justify-center active:scale-90">
                ❤
            </button>

        </div>

    </div>
</div>

<!-- MATCH POPUP -->
<div id="matchPopup" 
     class="fixed inset-0 bg-black/70 backdrop-blur-md hidden items-center justify-center z-[9999]">

    <div class="bg-white rounded-3xl p-6 w-[90%] max-w-sm text-center shadow-2xl animate-scaleIn">

        <h1 class="text-4xl font-bold text-pink-600 mb-3">❤️ It's a Match!</h1>
        <p class="text-gray-600 mb-4 text-lg">You both liked each other!</p>

        <div class="flex justify-center gap-4 mb-5">
            <img id="myPhoto" class="w-20 h-20 rounded-full object-cover shadow-md">
            <img id="theirPhoto" class="w-20 h-20 rounded-full object-cover shadow-md">
        </div>

        <button id="messageBtn"
            class="block w-full bg-pink-600 text-white py-3 rounded-xl font-bold text-lg mb-3">
            Send Message
        </button>

        <button id="continueBtn"
            class="block w-full bg-gray-200 text-gray-800 py-3 rounded-xl font-bold text-lg">
            Keep Swiping
        </button>

    </div>
</div>

<!-- PROFILE VIEW MODAL -->
<div id="profileModal"
     class="fixed inset-0 bg-black/70 backdrop-blur-md hidden items-center justify-center z-[99999]">

    <div class="bg-white p-6 rounded-3xl w-[90%] max-w-md">
        <img id="profileModalPhoto" class="w-full h-64 object-cover rounded-2xl mb-4">
        <h2 id="profileModalName" class="text-2xl font-bold mb-2"></h2>
        <p id="profileModalBio" class="text-gray-600"></p>

        <button onclick="closeProfileModal()"
            class="mt-5 w-full bg-pink-600 text-white py-3 rounded-xl">Close</button>
    </div>
</div>

<style>
/*** Animations ***/
@keyframes scaleIn {
    0% { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.animate-scaleIn { animation: scaleIn 0.4s ease-out; }

@keyframes shakeAnim {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(8deg); }
    50% { transform: rotate(-8deg); }
    75% { transform: rotate(5deg); }
    100% { transform: rotate(0deg); }
}
.shake { animation: shakeAnim 0.3s; }

@keyframes floatUp {
    from { transform: translate(-50%, 20px); opacity: 0; }
    to { transform: translate(-50%, -80px); opacity: 1; }
}
.floating-emoji {
    position: absolute;
    font-size: 40px;
    animation: floatUp 1s ease-out forwards;
    left: 50%;
    top: 50%;
}

/*** Heart Burst ***/
.heart-burst {
    position: absolute;
    left: 50%; top: 50%;
    transform: translate(-50%, -50%);
    font-size: 80px;
    animation: burst 0.6s ease-out forwards;
    pointer-events: none;
}
@keyframes burst {
    0% { transform: scale(0.2); opacity: 0; }
    100% { transform: scale(1.2); opacity: 1; }
}

/*** Touch Optimization ***/
.touching { transition: none !important; }
</style>

@endsection



@push('scripts')
<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
const cardArea = document.getElementById('card-area');
const noMore = document.getElementById('no-more');

let stack = [];
let lastSwipedCard = null;

/* -------------------------
    CREATE CARD
--------------------------- */
function createCard(user) {
    const card = document.createElement('div');
    card.className = `
        swipe-card absolute top-0 left-0 w-full h-full 
        bg-white rounded-3xl shadow-2xl overflow-hidden 
        transition-transform duration-300 ease-out
    `;

    card.style.position = "absolute";
    card.style.inset = "0";
    card.style.zIndex = stack.length + 1;
    card.style.transform = `scale(${1 - stack.length * 0.02}) translateY(${stack.length * 12}px)`;

    card.__user = user;

    const photo = user.profile?.profile_photo ? `/storage/${user.profile.profile_photo}` : `/images/placeholder.png`;
    const age = user.profile?.age ?? "";
    const city = user.profile?.city ?? "";
    const bio = user.profile?.bio ?? "";

    card.innerHTML = `
        <img src="${photo}" class="w-full h-72 object-cover rounded-t-3xl">

        <div class="p-5">
            <h2 class="text-xl font-bold">${user.name}</h2>
            <p class="text-gray-500">${age} • ${city}</p>
            <p class="mt-3 text-gray-700">${bio}</p>
        </div>
    `;

    // Tap to open profile full screen
    card.onclick = () => openProfileModal(user);

    addGesture(card);
    return card;
}



/* -------------------------
      GESTURE CONTROL
--------------------------- */
function addGesture(card) {
    let startX = 0, currentX = 0, isDragging = false;

    card.addEventListener('mousedown', start);
    card.addEventListener('touchstart', start, { passive: true });

    function start(e) {
        isDragging = true;
        startX = (e.touches ? e.touches[0].clientX : e.clientX);
        card.style.transition = "none";
        card.classList.add("touching");

        window.addEventListener('mousemove', move);
        window.addEventListener('mouseup', end);

        window.addEventListener('touchmove', move, { passive: false });
        window.addEventListener('touchend', end);
    }

    function move(e) {
        if (!isDragging) return;
        currentX = (e.touches ? e.touches[0].clientX : e.clientX);
        const dx = currentX - startX;

        let angle = Math.max(-15, Math.min(15, dx / 12));
        card.style.transform = `translate3d(${dx}px, 0, 0) rotate(${angle}deg)`;
    }

    function end() {
        isDragging = false;
        card.classList.remove("touching");

        const dx = currentX - startX;
        let velocity = dx / 200;

        if (velocity > 1.5) return swipeAction("like", card.__user, card);
        if (velocity < -1.5) return swipeAction("dislike", card.__user, card);

        if (dx > 120) swipeAction("like", card.__user, card);
        else if (dx < -120) swipeAction("dislike", card.__user, card);
        else {
            card.style.transform = "translate3d(0,0,0) rotate(0deg) scale(1.02)";
            setTimeout(() => {
                card.style.transform = "translate3d(0,0,0) rotate(0deg) scale(1)";
            }, 150);
        }

        window.removeEventListener('mousemove', move);
        window.removeEventListener('mouseup', end);
    }
}



/* -------------------------
        SWIPE ACTION
--------------------------- */
async function swipeAction(type, user, card) {

    lastSwipedCard = user;

    if (type === "like") {
        let heart = document.createElement("div");
        heart.className = "heart-burst";
        heart.innerHTML = "❤️";
        card.appendChild(heart);
    }

    if (type === "dislike") card.classList.add("shake");

    let emoji = document.createElement("div");
    emoji.className = "floating-emoji";
    emoji.innerText = type === "like" ? "😍" : "💔";
    card.appendChild(emoji);

    card.style.transform =
        type === "like" ? "translateX(500px) rotate(30deg)"
                        : "translateX(-500px) rotate(-30deg)";

    setTimeout(() => {
        card.remove();
        loadNext();
    }, 300);

    let res = await fetch("{{ route('swipe.action') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": CSRF_TOKEN
        },
        body: JSON.stringify({
            target_id: user.id,
            type: type
        })
    });

    let result = await res.json();

    if (result.match === true && type === "like") {
        showMatchPopup(user);
    }
}



/* -------------------------
       MATCH POPUP
--------------------------- */
function showMatchPopup(user) {
    let popup = document.getElementById("matchPopup");

    document.getElementById("myPhoto").src =
        "{{ auth()->user()->profile && auth()->user()->profile->profile_photo
            ? '/storage/' . auth()->user()->profile->profile_photo
            : '/images/placeholder.png' }}";

    document.getElementById("theirPhoto").src =
        user.profile?.profile_photo ? "/storage/" + user.profile.profile_photo : "/images/placeholder.png";

    popup.classList.remove("hidden");
}

document.getElementById("continueBtn").onclick = () =>
    document.getElementById("matchPopup").classList.add("hidden");

document.getElementById("messageBtn").onclick = () =>
    window.location.href = "/matches";



/* -------------------------
       PROFILE MODAL
--------------------------- */
function openProfileModal(user) {
    document.getElementById("profileModalPhoto").src =
        user.profile?.profile_photo ? "/storage/" + user.profile.profile_photo : "/images/placeholder.png";

    document.getElementById("profileModalName").innerText = user.name;
    document.getElementById("profileModalBio").innerText = user.profile?.bio ?? "";

    document.getElementById("profileModal").classList.remove("hidden");
}

function closeProfileModal() {
    document.getElementById("profileModal").classList.add("hidden");
}



/* -------------------------
       LOAD NEXT CARD
--------------------------- */
async function loadNext() {
    const res = await fetch("{{ route('swipe.next') }}");
    const data = await res.json();

    if (!data.user) {
        noMore.classList.remove("hidden");
        return;
    }

    const card = createCard(data.user);
    cardArea.appendChild(card);
    stack.push(card);
}

for (let i = 0; i < 10; i++) loadNext();



/* -------------------------
          BUTTONS
--------------------------- */
document.getElementById("likeBtn").onclick = () => {
    if (stack.length) {
        let card = stack.pop();
        swipeAction("like", card.__user, card);
    }
};

document.getElementById("dislikeBtn").onclick = () => {
    if (stack.length) {
        let card = stack.pop();
        swipeAction("dislike", card.__user, card);
    }
};

document.getElementById("superLikeBtn").onclick = () => {
    if (stack.length) {
        let card = stack.pop();
        swipeAction("superlike", card.__user, card);
    }
};

document.getElementById("undoBtn").onclick = () => {
    if (!lastSwipedCard) return;
    const card = createCard(lastSwipedCard);
    cardArea.appendChild(card);
    stack.push(card);
    lastSwipedCard = null;
};
</script>
@endpush
