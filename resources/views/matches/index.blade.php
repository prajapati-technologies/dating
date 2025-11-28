@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-600 to-purple-700 flex flex-col items-center py-10 px-4">

    <div class="w-full max-w-4xl">

        <!-- Header + Filters -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-extrabold">Discover Profiles</h1>

            <div class="flex items-center gap-3">
                <button id="openFilters" 
                    class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
                    Filters
                </button>

                <a href="{{ route('dashboard') }}" 
                    class="bg-white text-pink-600 px-4 py-2 rounded-lg font-bold">
                    Back
                </a>
            </div>
        </div>

        <!-- Card Stack -->
        <div id="card-area" 
            class="relative mx-auto w-full max-w-md h-[640px] md:h-[720px]">

            <div id="no-more" 
                class="hidden absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h2 class="text-2xl font-bold">No more profiles</h2>
                    <p class="mt-2">Try adjusting your filters.</p>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-center gap-6">
            <button id="dislikeBtn" 
                class="bg-red-500 text-white w-16 h-16 rounded-full text-3xl shadow-xl">
                ✖
            </button>

            <button id="likeBtn" 
                class="bg-green-500 text-white w-16 h-16 rounded-full text-3xl shadow-xl">
                ❤
            </button>
        </div>

    </div>
</div>

<!-- FILTERS MODAL -->
<div id="filtersModal" 
    class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">

    <div class="bg-white w-full max-w-lg p-6 rounded-2xl shadow-2xl">

        <h3 class="text-xl font-bold mb-4">Filters</h3>

        <form id="filtersForm" class="space-y-4">

            <!-- Gender -->
            <div>
                <label class="block text-sm font-bold mb-1">Gender</label>
                <select name="gender" class="w-full border rounded-lg p-2">
                    <option value="">Any</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Age Range -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">Min Age</label>
                    <input type="number" name="min_age" 
                           class="w-full border rounded-lg p-2" placeholder="18">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Max Age</label>
                    <input type="number" name="max_age" 
                           class="w-full border rounded-lg p-2" placeholder="60">
                </div>
            </div>

            <!-- City -->
            <div>
                <label class="block text-sm font-bold mb-1">City</label>
                <input type="text" name="city" 
                       class="w-full border rounded-lg p-2" placeholder="City">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4">
                <button id="closeFilters" 
                        type="button"
                        class="px-4 py-2 bg-gray-200 rounded-lg">
                    Close
                </button>

                <button type="submit" 
                        class="px-4 py-2 bg-pink-600 text-white rounded-lg">
                    Apply
                </button>
            </div>

        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
const cardArea = document.getElementById("card-area");
const noMore = document.getElementById("no-more");

const likeBtn = document.getElementById("likeBtn");
const dislikeBtn = document.getElementById("dislikeBtn");

let filters = {};
let stack = [];
let loading = false;

/* ------------------------------
     LOAD NEXT PROFILE
------------------------------ */
async function loadNextCard() {

    let query = new URLSearchParams(filters).toString();

    const res = await fetch("{{ route('swipe.next') }}?" + query);
    const data = await res.json();

    if (!data.user) {
        if (stack.length === 0) noMore.classList.remove("hidden");
        return;
    }

    const card = createCard(data.user);
    cardArea.appendChild(card);
    stack.push(card);
}

/* ------------------------------
     CREATE SWIPE CARD
------------------------------ */
function createCard(user) {

    const card = document.createElement("div");

    card.className = `
        swipe-card absolute inset-0 w-full h-full 
        bg-white rounded-3xl overflow-hidden shadow-2xl
        transform transition-all duration-300
    `;

    card.__user = user; // IMPORTANT

    card.innerHTML = `
        <div class="h-[70%] w-full bg-gray-200">
            <img src="${user.profile?.profile_photo 
                ? '/storage/' + user.profile.profile_photo 
                : '/images/placeholder.png'}"
                class="w-full h-full object-cover">
        </div>

        <div class="p-4">
            <h2 class="text-xl font-bold">${user.name}</h2>
            <p class="text-gray-600">
                ${user.profile?.age || ''} yrs • 
                ${user.profile?.city || ''}
            </p>

            <p class="mt-3 text-gray-700">
                ${user.profile?.bio?.substring(0, 120) || ''}
            </p>
        </div>

        <div class="absolute left-4 top-4 text-3xl font-bold text-green-500 opacity-0 like-label">
            LIKE
        </div>

        <div class="absolute right-4 top-4 text-3xl font-bold text-red-500 opacity-0 nope-label">
            NOPE
        </div>
    `;

    addSwipeGesture(card);

    return card;
}

/* ------------------------------
     SWIPE GESTURES
------------------------------ */
function addSwipeGesture(card) {

    let startX = 0, currentX = 0, dragging = false;

    card.addEventListener("mousedown", start);
    card.addEventListener("touchstart", start);

    function start(e) {
        dragging = true;
        startX = e.touches ? e.touches[0].clientX : e.clientX;
    }

    window.addEventListener("mousemove", move);
    window.addEventListener("touchmove", move);

    function move(e) {
        if (!dragging) return;

        currentX = e.touches ? e.touches[0].clientX : e.clientX;
        let dx = currentX - startX;

        card.style.transform = `translateX(${dx}px) rotate(${dx / 10}deg)`;

        card.querySelector(".like-label").style.opacity = dx > 0 ? Math.min(dx / 120, 1) : 0;
        card.querySelector(".nope-label").style.opacity = dx < 0 ? Math.min(-dx / 120, 1) : 0;
    }

    window.addEventListener("mouseup", end);
    window.addEventListener("touchend", end);

    function end() {
        if (!dragging) return;
        dragging = false;

        let dx = currentX - startX;

        if (dx > 120) {
            swipeAction("like", card.__user, card);
        } else if (dx < -120) {
            swipeAction("dislike", card.__user, card);
        } else {
            card.style.transform = "";
            card.querySelector(".like-label").style.opacity = 0;
            card.querySelector(".nope-label").style.opacity = 0;
        }
    }
}

/* ------------------------------
     SWIPE ACTION (AJAX)
------------------------------ */
async function swipeAction(type, user, card) {

    card.style.transition = "0.5s";
    card.style.transform = `translateX(${type === "like" ? 300 : -300}px) rotate(${type === "like" ? 30 : -30}deg)`;

    setTimeout(() => card.remove(), 500);

    stack.pop();

    await fetch("{{ route('swipe.action') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            target_id: user.id,
            type: type
        })
    });

    loadNextCard();
}

/* ------------------------------
     FILTERS
------------------------------ */
document.getElementById("openFilters").onclick = () => {
    document.getElementById("filtersModal").classList.remove("hidden");
};

document.getElementById("closeFilters").onclick = () => {
    document.getElementById("filtersModal").classList.add("hidden");
};

document.getElementById("filtersForm").onsubmit = e => {
    e.preventDefault();

    const form = new FormData(e.target);

    filters = {};

    form.forEach((value, key) => {
        if (value) filters[key] = value;
    });

    stack.forEach(c => c.remove());
    stack = [];
    noMore.classList.add("hidden");

    document.getElementById("filtersModal").classList.add("hidden");

    loadNextCard();
    loadNextCard();
};

loadNextCard();
loadNextCard();

</script>
@endsection
