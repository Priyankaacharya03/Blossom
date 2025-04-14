@extends('site.layouts.main')

@section('title', 'Blog')

@section('main-section')

<style>
    .blog-section {
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<h1>Blog Page</h1>
<p>This is the Blog page content.</p>

<main class="py-10 px-4">
    <div class="blog-section">
        <!-- Skincare Section -->
        <div class="card p-6 mb-6">
            <h2 class="text-2xl font-semibold text-pink-700 mb-3">Skincare Essentials</h2>
            <p class="text-gray-700">
                Use a gentle cleanser twice daily and follow with a moisturizer suited to your skin type—oily, dry, or combination. These products hydrate, reduce acne, and minimize fine lines, leaving your skin radiant and healthy.
            </p>
        </div>

        <!-- Makeup Section -->
        <div class="card p-6">
            <h2 class="text-2xl font-semibold text-pink-700 mb-3">Makeup Magic</h2>
            <p class="text-gray-700">
                Apply foundation evenly for flawless coverage, then add blush for a fresh glow. Match shades to your skin tone for the best effect. Perfect for all skin types, makeup enhances your natural beauty effortlessly.
            </p>
        </div>
    </div>
</main>


@endsection