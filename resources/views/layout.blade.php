<!DOCTYPE html>
<html>

<head>
    <title>Technical Exam - Tabulate</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-white text-black">
    <div class="flex gap-4">
        <aside class="w-56 bg-black p-4 min-h-screen text-white">
            <h3 class="text-xl font-bold uppercase">Tabulate</h3>
            <ul class="flex flex-col gap-2 py-4 px-2 text-[12px]">
                <li class="hover:bg-gray-800/60 rounded-md p-2 text-white">
                    <a href="/customers" class="flex items-center gap-2">
                        <i class="fa-solid fa-user"></i>
                        Customers
                    </a>
                </li>
                <li class="hover:bg-gray-800/60 rounded-md p-2">
                    <a href="/invoices" class="flex items-center gap-2">
                        <i class="fa-solid fa-file-invoice"></i>
                        Invoices
                    </a>
                </li>
                <li class="hover:bg-gray-800/60 rounded-md p-2">
                    <a href="#" class="flex items-center gap-2">
                        <i class="fa-solid fa-money-bill"></i>
                        Transactions
                    </a>
                </li>
            </ul>
        </aside>

        <div class="container mt-10 px-10">
            @yield('content')
        </div>
    </div>
</body>

</html>
