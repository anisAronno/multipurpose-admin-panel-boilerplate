<template>
    <div>
        <header>
            <nav>
                <div class="container mx-auto">
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-medium">My Landing Page</div>
                        <div class="flex">
                            <a href="#" class="px-3 py-2 text-gray-800">Home</a>
                            <a href="#" class="px-3 py-2 text-gray-800"
                                >About</a
                            >
                            <a href="#" class="px-3 py-2 text-gray-800"
                                >Github</a
                            >
                            <a href="#" class="px-3 py-2 text-gray-800"
                                >Wakatime</a
                            >
                            <a href="#" class="px-3 py-2 text-gray-800"
                                >Skills</a
                            >
                            <a href="#" class="px-3 py-2 text-gray-800"
                                >Projects</a
                            >
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="hero bg-gray-300 py-16">
                <div class="container mx-auto">
                    <h1 class="text-5xl font-medium text-center text-gray-800">
                        Welcome to My Landing Page
                    </h1>
                </div>
            </section>
            <section class="about bg-gray-200 py-16">
                <div class="container mx-auto">
                    <h2 class="text-xl font-medium text-center text-gray-800">
                        About Me
                    </h2>
                    <p class="text-lg py-4">
                        I'm a software engineer with experience in various
                        technologies such as Vue.js, Tailwind CSS, and the
                        Github and Wakatime API.
                    </p>
                </div>
            </section>
            <section class="github-state bg-gray-300 py-16">
                <div class="container mx-auto">
                    <h2 class="text-xl font-medium text-center text-gray-800">
                        Github State
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">10</p>
                            <p class="text-sm">Repositories</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">50</p>
                            <p class="text-sm">Followers</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">20</p>
                            <p class="text-sm">Following</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="wakatime-state bg-gray-200 py-16">
                <div class="container mx-auto">
                    <h2 class="text-xl font-medium text-center text-gray-800">
                        Wakatime State
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">50h</p>
                            <p class="text-sm">Coding Time</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">10</p>
                            <p class="text-sm">Languages</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">5</p>
                            <p class="text-sm">Editors</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="skills bg-gray-300 py-16">
                <div class="container mx-auto">
                    <h2 class="text-xl font-medium text-center text-gray-800">
                        My Skills
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">Vue.js</p>
                            <p class="text-sm">90%</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">JavaScript</p>
                            <p class="text-sm">80%</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">CSS</p>
                            <p class="text-sm">70%</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="projects bg-gray-200 py-16">
                <div class="container mx-auto">
                    <h2 class="text-xl font-medium text-center text-gray-800">
                        My Projects
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">Project 1</p>
                            <p class="text-sm">Vue.js, Tailwind CSS</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">Project 2</p>
                            <p class="text-sm">JavaScript, HTML, CSS</p>
                        </div>
                        <div class="bg-white p-4 text-center">
                            <p class="text-xl font-medium">Project 3</p>
                            <p class="text-sm">React, Node.js</p>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="bg-white py-6">
                <div class="container mx-auto">
                    <div class="text-center">
                        <p class="text-gray-600">
                            Copyright © 2021 My Landing Page
                        </p>
                        <p class="text-gray-600">Email: example@email.com</p>
                        <p class="text-gray-600">Phone: +1234567890</p>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</template>
