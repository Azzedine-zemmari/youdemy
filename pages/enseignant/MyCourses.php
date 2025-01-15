<?php
// Include database connection
// session_start();
require_once __DIR__."/../../class/Enseignant.php";
$enseignantId = $_SESSION['userId'];
$cours = Enseignant::showMyCourses($enseignantId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - EduPortal</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">My Courses</h1>
        
        <table id="example" class="display table-auto w-full text-sm text-left text-gray-600">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Titre</th>
                    <th class="py-3 px-4">Description</th>
                    <th class="py-3 px-4">Contenu</th>
                    <th class="py-3 px-4">Catégorie</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Date Created</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach($cours as $cour): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?= $cour['idCours'] ?></td>
                        <td class="py-3 px-4"><?= $cour['titre'] ?></td>
                        <td class="py-3 px-4"><?= $cour['description'] ?></td>
                        <td class="py-3 px-4"><?= $cour['contenu'] ?></td>
                        <td class="py-3 px-4"><?= $cour['nom'] ?></td>
                        <td class="py-3 px-4"><?= $cour['type'] ?></td>
                        <td class="py-3 px-4"><?= $cour['price'] ?></td>
                        <td class="py-3 px-4"><?= $cour['date_creation'] ?></td>
                        <td class="py-3 px-4 flex gap-2">
                            <a href="edit.php?id=<?= $cour['idCours'] ?>" class="text-blue-500 hover:text-blue-700 transition-colors duration-300">Edit</a> | 
                            <a href="delete.php?id=<?= $cour['idCours'] ?>" class="text-red-500 hover:text-red-700 transition-colors duration-300" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#example').DataTable({
                "pagingType": "simple_numbers",
                "pageLength": 10,
            });
        });
    </script>
</body>
</html>
