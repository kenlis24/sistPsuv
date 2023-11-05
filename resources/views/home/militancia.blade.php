@extends('layouts.template')

@section('contenido')
<body class="">
 
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card demo-icons">
                <div class="card-header">
                  <h5 class="card-title">Asistencia</h5>
                  <p class="card-category"></p>
                </div>
                <div class="card-body all-icons">
                  <div>
                    <section>
                      <ul>
                        <li>
                            <a href="{{ route('militancia.militantesMunicipios') }}">
                                <i class="nc-icon nc-globe text-danger"></i>
                                <h4>Asistencia Municipios</h4>
                            </a>
                        </li>
                        <li>
                          <i class="nc-icon nc-album-2"></i>
                          <p>nc-album-2</p>
                        </li>
                        <li>
                          <i class="nc-icon nc-alert-circle-i"></i>
                          <p>nc-alert-circle-i</p>
                        </li>
                        <li>
                          <i class="nc-icon nc-align-center"></i>
                          <p>nc-align-center</p>
                        </li>
                        <li>
                          <i class="nc-icon nc-align-left-2"></i>
                          <p>nc-align-left-2</p>
                        </li>                        
                        <!-- list of icons here with the proper class-->
                      </ul>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
      function SelectText(element) {
        var doc = document,
          text = element,
          range, selection;
        if (doc.body.createTextRange) {
          range = document.body.createTextRange();
          range.moveToElementText(text);
          range.select();
        } else if (window.getSelection) {
          selection = window.getSelection();
          range = document.createRange();
          range.selectNodeContents(text);
          selection.removeAllRanges();
          selection.addRange(range);
        }
      }
      window.onload = function() {
        var iconsWrapper = document.getElementById('icons-wrapper'),
          listItems = iconsWrapper.getElementsByTagName('li');
        for (var i = 0; i < listItems.length; i++) {
          listItems[i].onclick = function fun(event) {
            var selectedTagName = event.target.tagName.toLowerCase();
            if (selectedTagName == 'p' || selectedTagName == 'em') {
              SelectText(event.target);
            } else if (selectedTagName == 'input') {
              event.target.setSelectionRange(0, event.target.value.length);
            }
          }
  
          var beforeContentChar = window.getComputedStyle(listItems[i].getElementsByTagName('i')[0], '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, ""),
            beforeContent = beforeContentChar.charCodeAt(0).toString(16);
          var beforeContentElement = document.createElement("em");
          beforeContentElement.textContent = "\\" + beforeContent;
          listItems[i].appendChild(beforeContentElement);
  
          //create input element to copy/paste chart
          var charCharac = document.createElement('input');
          charCharac.setAttribute('type', 'text');
          charCharac.setAttribute('maxlength', '1');
          charCharac.setAttribute('readonly', 'true');
          charCharac.setAttribute('value', beforeContentChar);
          listItems[i].appendChild(charCharac);
        }
      }
    </script>
  </body>
@endsection