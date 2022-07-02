
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parser CVS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="{{route('getFile')}}" enctype="multipart/form-data"  method="post">
        @csrf
        <div class="flex justify-center mt-5">
            <div class="mb-3 w-96">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Import CVS</label>
                <input name="file" class="form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile">
                <button type="submit" class="mt-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Import</button>
            </div>
        </div>
    </form>
    @if (isset($file))
        <div class="flex flex-col justify-center mt-5">

            <div class="flex flex-col justify-center items-center">
                
                <h3>1. Сначала создаем input для загрузки файла.</h3>
                <h3>2. Затем сохраняем файл в файловой системе, задавем имя файла исходя из времени загрузки.</h3>
                <h3>3. Открываем файл и читаем данные. Подготовливаем новый массив $csv для извлечения данных.</h3>
                <h3>4. Извлекаем данные.</h3>
                <h3>5. Функцией createtree получаем новый массив преобразованных данных.</h3>
                <h3>6. Данные сохрянем в JSON имя задем также как и входящему файлу</h3>
                <h3>7. Создаем ссылку для скачивания файла JSON</h3>
            </div>
            
            <div class="flex justify-center mt-5">
                <a class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out" href="{{route('download', ['file' => $file])}}">
                    Скачать JSON
                </a>
            </div>
        </div>
    @endif
</body>
</html>