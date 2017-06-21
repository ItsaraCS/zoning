
    <script type="text/javascript">
        $(document).ready(function(e) {
            //--Variable

            //--Page load
            setInit();

            //--Function
            function setInit() {
                factory.initService.setMenu();
                factory.utilityService.getDataImportant();
                
                $.datepicker.regional['th'] = { //--Datepicker
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
                    yearOffSet: 543
                };
                $.datepicker.setDefaults($.datepicker.regional['th']);
                $('.datepicker').datepicker($.datepicker.regional['th']);
                $('.datepicker').datepicker('setDate', new Date());
            }

            //--Event
            $(document).on('click', '.datepicker-btn', function(e){
                e.preventDefault();

                $(this).closest('.input-group').find('input').focus();
            });

            $(document).on('click', '.user-menu', function(e) {
                e.stopPropagation();

                $('.user-menu-detail').toggleClass('show');
            });

            $(window).click(function(e) {
                if($('.user-menu-detail').hasClass('show')) 
                    $('.user-menu-detail').toggleClass('show');
            });

        });
    </script>
</body>
</html>