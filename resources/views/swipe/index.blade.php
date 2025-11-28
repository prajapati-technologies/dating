@extends('layouts.app')

@section('content')

<!-- FULL SCREEN PINK GRADIENT BACKGROUND -->
<div class="min-h-screen bg-gradient-to-br from-pink-600 via-pink-500 to-purple-600 flex flex-col items-center py-10 px-4">

    <!-- CONTAINER -->
    <div class="w-full max-w-4xl">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-extrabold">
                💖 Discover Profiles
            </h1>

            <div class="flex items-center gap-3">
                <button id="openFilters"
                        class="bg-white/20 border border-white/30 text-white px-4 py-2 rounded-xl hover:bg-white/30 transition">
                    Filters
                </button>

                <a href="{{ route('dashboard') }}"
                   class="bg-white text-pink-600 px-4 py-2 rounded-xl font-semibold shadow">
                    Back
                </a>
            </div>
        </div>

        <!-- SWIPE CARD AREA -->
        <div id="card-area"
             class="relative mx-auto w-full max-w-md h-[640px] md:h-[720px]">

            <div id="no-more"
                 class="hidden absolute inset-0 flex items-center justify-center text-white text-center">
                <div>
                    <h2 class="text-3xl font-bold">No More Profiles</h2>
                    <p class="mt-2 text-lg">Please change filters or try again later.</p>
                </div>
            </div>

        </div>

        <!-- ACTION BUTTONS -->
        <div class="mt-8 flex justify-center gap-6">
            <button id="undoBtn"
                    class="bg-white/20 text-white w-14 h-14 rounded-full flex items-center justify-center text-xl shadow-xl hover:bg-white/30">
                ↺
            </button>
            <button id="dislikeBtn"
                    class="bg-red-500 text-white w-20 h-20 rounded-full text-3xl shadow-xl hover:bg-red-600">
                ✖
            </button>
            <button id="likeBtn"
                    class="bg-green-500 text-white w-20 h-20 rounded-full text-3xl shadow-xl hover:bg-green-600">
                ❤
            </button>
        </div>

    </div>
</div>


<!-- FILTER MODAL -->
<div id="filtersModal" class="fixed inset-0 hidden items-center justify-center z-50">
    <div class="absolute inset-0 bg-black/50" id="filtersBackdrop"></div>

    <div class="relative bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
        <h3 class="text-xl font-bold mb-4">Filters</h3>

        <form id="filtersForm" class="space-y-4">

            <div>
                <label class="block text-sm font-semibold text-gray-700">Gender</label>
                <select name="gender" class="w-full border rounded-lg p-2">
                    <option value="">Any</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold">Min Age</label>
                    <input type="number" name="min_age" class="w-full border rounded-lg p-2" placeholder="18">
                </div>
                <div>
                    <label class="text-sm font-semibold">Max Age</label>
                    <input type="number" name="max_age" class="w-full border rounded-lg p-2" placeholder="60">
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold">City</label>
                <input type="text" name="city" class="w-full border rounded-lg p-2" placeholder="City name">
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" id="clearFilters"
                        class="px-4 py-2 bg-gray-200 rounded-lg">
                    Clear
                </button>
                <button type="submit"
                        class="px-5 py-2 bg-pink-600 text-white rounded-lg font-semibold">
                    Apply
                </button>
            </div>

        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

let stack = [];
let history = [];
let filters = {};
let loading = false;

const cardArea = document.getElementById('card-area');
const noMore = document.getElementById('no-more');


// CREATE CARD UI
function createCard(user) {

    const card = document.createElement('div');
    card.className =
        "swipe-card absolute inset-x-0 mx-auto top-0 w-[320px] md:w-[380px] h-[520px] md:h-[600px] rounded-3xl overflow-hidden shadow-2xl bg-white transform transition";

    card.__user = user;

    card.innerHTML = `
        <div class="h-[65%] bg-gray-300 relative">
            <img src="${user.profile?.profile_photo ? '/storage/' + user.profile.profile_photo : '/images/default.png'}"
                 class="w-full h-full object-cover">

            <div class="absolute left-4 top-4 bg-green-500 text-white px-3 py-1 text-lg font-bold rounded-lg opacity-0 like-label">LIKE</div>
            <div class="absolute right-4 top-4 bg-red-500 text-white px-3 py-1 text-lg font-bold rounded-lg opacity-0 nope-label">NOPE</div>
        </div>

        <div class="p-4">
            <h3 class="text-xl font-bold">${user.name}</h3>
            <p class="text-gray-600">${user.profile?.age ?? '—'} yrs • ${user.profile?.city ?? 'Unknown'}</p>
            <p class="text-gray-700 mt-3">${user.profile?.bio?.slice(0, 120) ?? ''}</p>
        </div>
    `;

    addSwipeEvents(card);
    return card;
}



// SWIPE GESTURES
function addSwipeEvents(card) {

    let startX = 0, currentX = 0, dragging = false;

    card.addEventListener('mousedown', e => {
        dragging = true;
        startX = e.clientX;
        card.style.transition = 'none';
    });

    window.addEventListener('mousemove', e => {
        if (!dragging) return;
        currentX = e.clientX;

        let dx = currentX - startX;
        card.style.transform = `translateX(${dx}px) rotate(${dx / 15}deg)`;

        let likeLabel = card.querySelector('.like-label');
        let nopeLabel = card.querySelector('.nope-label');

        let opacity = Math.min(Math.abs(dx) / 120, 1);

        if (dx > 0) {
            likeLabel.style.opacity = opacity;
            nopeLabel.style.opacity = 0;
        } else {
            likeLabel.style.opacity = 0;
            nopeLabel.style.opacity = opacity;
        }
    });

    window.addEventListener('mouseup', () => {
        if (!dragging) return;
        dragging = false;

        let dx = currentX - startX;

        if (dx > 120) {
            animateSwipe(card, 'right');
        } else if (dx < -120) {
            animateSwipe(card, 'left');
        } else {
            card.style.transition = '0.25s';
            card.style.transform = '';
            card.querySelector('.like-label').style.opacity = 0;
            card.querySelector('.nope-label').style.opacity = 0;
        }
    });
}



// SWIPE ANIMATION + ACTION
function animateSwipe(card, direction) {

    card.style.transition = '0.4s';

    let x = direction === 'right' ? 600 : -600;
    card.style.transform = `translateX(${x}px) rotate(${direction === 'right' ? 25 : -25}deg)`;

    setTimeout(() => {
        card.remove();
        handleSwipe(direction === 'right' ? "like" : "dislike", card.__user);
    }, 250);
}



// HANDLE LIKE / DISLIKE
async function handleSwipe(type, user) {

    await fetch("{{ route('swipe.action') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": CSRF
        },
        body: JSON.stringify({
            target_id: user.id,
            type: type
        })
    });

    history.push({ type, user });

    loadNextCard();
}



// LOAD NEXT CARD
async function loadNextCard() {

    const query = new URLSearchParams(filters).toString();

    const res = await fetch("{{ route('swipe.next') }}?" + query);
    const data = await res.json();

    if (!data.user) {
        if (stack.length === 0) noMore.classList.remove('hidden');
        return;
    }

    const card = createCard(data.user);
    cardArea.appendChild(card);
    stack.push(card);
}



// INIT — LOAD FIRST CARDS
loadNextCard();
loadNextCard();
loadNextCard();



// BUTTON EVENTS
document.getElementById('likeBtn').onclick = () => {
    if (stack.length === 0) return;
    let card = stack.pop();
    animateSwipe(card, 'right');
};

document.getElementById('dislikeBtn').onclick = () => {
    if (stack.length === 0) return;
    let card = stack.pop();
    animateSwipe(card, 'left');
};



// FILTER MODAL
document.getElementById('openFilters').onclick = () =>
    document.getElementById('filtersModal').classList.remove('hidden');

document.getElementById('filtersBackdrop').onclick = () =>
    document.getElementById('filtersModal').classList.add('hidden');

document.getElementById('filtersForm').onsubmit = e => {
    e.preventDefault();

    filters = Object.fromEntries(new FormData(e.target).entries());

    document.getElementById('filtersModal').classList.add('hidden');

    cardArea.innerHTML = "";
    stack = [];
    noMore.classList.add('hidden');

    loadNextCard();
    loadNextCard();
    loadNextCard();
};

document.getElementById('clearFilters').onclick = () => {
    filters = {};
    document.getElementById('filtersForm').reset();
};

</script>
@endsection
