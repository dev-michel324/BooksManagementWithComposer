
<div class="list-books">
<table class="algn-center-horizontal">
    <thead>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Adicionado Por</th>
    </thead>
    <tbody>
        <?php
            use Michel\Projeto\Models\Book;
            $results = Book::listAllBooksOrFromUser();

            while($res = $results->fetchArray()){
                echo "<tr>";
                echo "<td>" . $res['boo_title'] . "</td>";
                echo "<td>" . $res['boo_autor'] . "</td>";
                echo "<td>" . $res['boo_year'] . "</td>";
                if ($res['email'] == $_SESSION['user']){
                    echo "<td>" . 'Eu' . "</td>";
                }else{
                    echo "<td>" . $res['email'] . "</td>";
                }
                echo "</tr>";
            }

        ?>

    </tbody>
</table>
</div>