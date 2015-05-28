<?php
echo $this->Html->script('Dropzone.dropzone', false);
$this->append('css');
echo $this->Html->css('Dropzone.dropzone', false);
$this->end();
$this->append('script');
?>
<script>
    $(document).ready(function(){
        var removeIconDom = '<div class="remove-attachment"><?php echo $this->Html->image('Shop.delete.png');?> </div>';
        Dropzone.options.myDropzone = {
            paramName : 'data[Attachment][file]',
            previewTemplate: document.querySelector('#template').innerHTML,
            success: function(file, response){
                response = JSON.parse(response);
                var inputDom = '<input id="attachment-'+response.data.attachment_id+'" type="hidden" name="data[Attachment][]" value="'+response.data.attachment_id+'" />';
                var inputHidden = Dropzone.createElement(inputDom);
                $('.dz-preview').append(removeIconDom);
                file.previewElement.appendChild(inputHidden);
            }
        }
        $('body').on('click', 'div.remove-attachment', function(){
            $(this).parent("div").remove();
        });
    });
</script>
<?php
$this->end();
$attachments = $this->request->data['Attachment'];
$dropzoneClass = 'dropzone';
if(!empty($attachments)){
    $dropzoneClass .= ' dz-clickable dz-started ';
}
?>
<style>
    .remove-attachment{
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 99;
        cursor: pointer !important;
        display: none;
    }
    .dropzone .dz-preview:hover .remove-attachment{
        display: block;
    }
</style>
<div class="hidden-attachments"></div>
<div action="<?php echo Router::url($uploadUrl);?>" class="<?php echo $dropzoneClass;?>" id="my-dropzone">
    <div class="dz-message">Drop files here or click to upload.</div>
    <?php
    foreach($attachments as $attachment){
    ?>
        <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete" id="">
            <div class="dz-image">
                <?php
                echo $this->html->image($attachment['path'], array(
                    'data-dz-thumbnail' => '',
                    'alt' => $attachment['title'],
                    'style' => 'width:60px; height:60px'
                ))
                ?>
            </div>
            <div class="dz-details">
                <div class="dz-size" data-dz-size=""><strong>59.6</strong> KB</div>
            </div>
            <div class="remove-attachment"><?php echo $this->Html->image('Shop.delete.png');?> </div>
            <input id="attachment-<?php echo $attachment['id']; ?>" type="hidden" name="data[Attachment][]" value="<?php echo $attachment['id']; ?>">
        </div>
    <?php
    }
    ?>
</div>
<div id="template" style="display: none">
    <div class="dz-preview dz-file-preview">
        <div class="dz-image">
            <img data-dz-thumbnail />
        </div>
        <div class="dz-details">
            <!--            <div class="dz-filename"><span data-dz-name></span></div>-->
            <div class="dz-size" data-dz-size></div>
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="dz-success-mark">
            <svg viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <title>Check</title>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <path
                        d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                        id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                        fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                </g>
            </svg>
        </div>
        <div class="dz-error-mark">
            <svg viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <title>Error</title>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158"
                       fill="#FFFFFF" fill-opacity="0.816519475">
                        <path
                            d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                            id="Oval-2" sketch:type="MSShapeGroup"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>