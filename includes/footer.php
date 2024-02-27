    <!-- APERTURA DE DIVS DE MENU NAV -->
    </main>
    </div>
    </div>
    <!-- CIERRE DE DIVS DE MENU NAV -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
    <script>
        //let table = new DataTable('#tb_cliente');

        $(document).ready(function () {
            $(table).DataTable({
                "pageLenght":5,
                lengthMenu:[
                    [5,10,25,50],
                    [5,10,25,50]
                ],
                "language":{
                    "url":"https:////cdn.datatables.net/plug-ins/2.0.0/i18n/es-AR.json"
                }
            });
        })
    </script>
</body>

</html>