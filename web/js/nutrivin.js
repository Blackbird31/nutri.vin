$(document).ready(function() {
  $('#ingredientsBox').select2({
    theme: "bootstrap-5",
    tags: true,
    tokenSeparators: [',', ', ', '.'],
    selectOnClose: true
  });
  $('.select2-selection__choice').on("click", function (e) { console.log($(this).title); });
  $('#ingredientsBox').on("select2:unselecting", function (e) {
    e.preventDefault();
    var selected = e.params.args.data.id;
    var values = $(this).val();

    // suppression
    values.splice(values.indexOf(selected), 1);
    $(this).val(values).trigger("change");

    $(this).data('unselecting', true);
  });
  $('#ingredientsBox').on("select2:opening", function (e) { if ($(this).data('unselecting')) { $(this).removeData('unselecting'); e.preventDefault(); } });
});
