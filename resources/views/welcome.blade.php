<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - 现代化虚拟商品销售平台</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <header class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ config('app.name') }}
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    一个现代、强大、高效的自动化虚拟商品销售平台
                </p>
                
                <!-- Tech Stack Badges -->
                <div class="flex flex-wrap justify-center gap-2 mb-8">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Laravel 12</span>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Livewire 3</span>
                    <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">Filament 3</span>
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-medium">MaryUI</span>
                    <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm font-medium">Tailwind CSS 4</span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">PostgreSQL</span>
                </div>
            </header>

            <!-- Main Content Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Features Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">🚀 核心功能</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>• 强大的后台管理系统</li>
                        <li>• 流畅的商城前端界面</li>
                        <li>• 灵活的支付集成</li>
                        <li>• 自动发货系统</li>
                        <li>• 订单管理与查询</li>
                    </ul>
                </div>

                <!-- Tech Stack Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">⚡ 技术栈</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Laravel 12 框架</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-orange-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Filament 3 后台</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Livewire 3 交互</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-pink-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">MaryUI 组件</span>
                        </div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">📋 项目状态</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Laravel 12 已配置</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Livewire 3 已安装</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">Filament 3 已配置</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-gray-600 dark:text-gray-300">MaryUI 已集成</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 text-center">快速开始</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-3">管理后台</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">访问 Filament 管理面板，管理商品、订单和系统设置</p>
                        <a href="/admin" class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors">
                            进入后台
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="text-center">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-3">开发文档</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">查看项目文档，了解开发进度和使用说明</p>
                        <a href="https://github.com/tsai0ajx/pxiuka" target="_blank" class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                            查看文档
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="text-center mt-12 text-gray-500 dark:text-gray-400">
                <p>{{ config('app.name') }} - 为现代化的虚拟商品交易而生</p>
                <p class="mt-2">
                    基于 Laravel {{ app()->version() }} 构建 | 
                    Powered by Livewire, Filament, MaryUI & Tailwind CSS
                </p>
            </footer>
        </div>
    </body>
</html>