var DS = DS || {};

function TDc(e) {
return '<td style="text-align:center;">' + e + "</td>"
}

function TDnum(e) {
return '<td style="text-align:right;">' + e + "</td>"
}

function THc(e, t) {
return "<th " + (t = void 0 !== t ? 'width="' + t + '"' : "") + ' style="text-align:center;">' + e + "</th>"
}

function A(e, t, n) {
return '<a href="javascript:void(0)" onclick="' + e + '" title="' + (t = t || "") + '">' + (n = n || '<i class="fa fa-edit"></i>') + "</a>"
}

function Ahref(e, t, n, i) {
return '<a href="' + e + '" title="' + (t = t || "") + '" target="' + (i = i || "_self") + '">' + (n = n || '<i class="fa fa-edit"></i>') + "</a>"
}

function CHECKBOX(e, t) {
if (void 0 === e) throw "ID is not initialize";
if (void 0 === t) throw "Name is not initialize";
return '<input type="checkbox" id="checkbox_' + e + '" class="checkbox" name="' + t + '[]" value="' + e + '">'
}

function CHECKALL() {
return '<input type="checkbox" class="check-all">'
}

function UPLOAD(e, t, n) {
if ("image" !== t && "file" !== t) throw "Not initialize type or type must image or file";
return '<a href="javascript:void(0)" onclick="' + e + '" title="' + (n = n || "") + '"><i class="fa ' + ("image" == t ? "fa-file-image-o" : "fa-upload") + '"></i></a>'
}

function ATTR(e, t) {
return " " + e + "=" + Z(t) + " "
}

function Z(e) {
return e ? '"' + (e = "" + e).replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;") + '"' : '""'
}
DS.PublishDraft = {
publish: "Diterbitkan",
draft: "Konsep"
}, DS.Visibility = {
public: "Publik",
private: "Private"
}, DS.AdmissionFormVisibility = {
public: "Ya",
private: "Tidak"
}, DS.TrueFalse = {
true: "Ya",
false: "Tidak"
}, DS.OpenClose = {
open: "Dibuka",
close: "Ditutup"
}, DS.IsAlumni = {
true: "Ya",
false: "Tidak",
unverified: "Belum Diverifikasi"
}, DS.SortDirection = {
asc: "Ascending",
desc: "Descending"
}, DS.CommentStatus = {
approved: "Komentar Diizinkan",
unapproved: "Tidak Disetujui",
spam: "Spam"
}, DS.Gender = {
M: "Laki-laki",
F: "Perempuan"
}, DS.Citizenship = {
WNI: "WNI",
WNA: "WNA"
}, DS.SchoolStatus = {
1: "Negeri",
2: "Swasta"
}, DS.LinkTarget = {
_self: "Self",
_blank: "Blank",
_parent: "Parent",
_top: "Top"
}, DS.CommentStatus = {
approved: "Approved",
unapproved: "Unapproved",
spam: "Spam"
}, toastr.options = {
closeButton: !0,
debug: !1,
newestOnTop: !1,
progressBar: !0,
positionClass: "toast-top-right",
preventDuplicates: !1,
showDuration: "300",
hideDuration: "1000",
timeOut: "5000",
extendedTimeOut: "1000",
showEasing: "swing",
hideEasing: "linear",
showMethod: "fadeIn",
hideMethod: "fadeOut"
}, Number.prototype.to_money = function(e, t) {
var n = "\\d(?=(\\d{" + (t || 3) + "})+" + (0 < e ? "\\." : "$") + ")";
return this.toFixed(Math.max(0, ~~e)).replace(new RegExp(n, "g"), "$&.")
};
var _H = _H || {};
if (_H.StrToObject = function(v) {
  if ("object" == typeof v) return v;
  if ("string" != typeof v) throw console.log(v), "cannot parse non-json-string";
  return "" == v ? v : eval("(" + v + ")")
}, _H.Notify = function(e, t) {
  switch (e) {
      case "success":
          toastr.success(t, "Sukses");
          break;
      case "info":
          toastr.info(t, "Info");
          break;
      case "warning":
          toastr.warning(t, "Peringatan");
          break;
      case "error":
      default:
          toastr.error(t, "Terjadi Kesalahan")
  }
}, _H.Month = function(e) {
  var t = {
      "01": "Januari",
      "02": "Februari",
      "03": "Maret",
      "04": "April",
      "05": "Mei",
      "06": "Juni",
      "07": "Juli",
      "08": "Agustus",
      "09": "September",
      10: "Oktober",
      11: "Nopember",
      12: "Desember"
  };
  return void 0 === e ? t : t[e]
}, _H.IsValidDate = function(e) {
  if (!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(e)) return !1;
  var t = e.split("-"),
      n = parseInt(t[2], 10),
      i = parseInt(t[1], 10),
      o = parseInt(t[0], 10);
  if (o < 1e3 || 3e3 < o || 0 == i || 12 < i) return !1;
  var r = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
  return (o % 400 == 0 || o % 100 != 0 && o % 4 == 0) && (r[1] = 29), 0 < n && n <= r[i - 1]
}, _H.DayName = function(e) {
  _H.IsValidDate(e) || console.error(e + " is not valid date");
  return ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][new Date(e).getDay()]
}, _H.ToIndonesianDate = function(e) {
  if (null != e) {
      var t = e.split("-"),
          n = t[0],
          i = t[1];
      return t[2] + " " + _H.Month(i) + " " + n
  }
}, _H.FormatBytes = function(e, t) {
  if (0 == e) return "0 Byte";
  var n = t + 1 || 3,
      i = Math.floor(Math.log(e) / Math.log(1e3));
  return (e / Math.pow(1e3, i)).toPrecision(n) + " " + ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"][i]
}, _H.Message = function(e) {
  var t = "";
  switch (e) {
      case "created":
          t = "Data Anda telah disimpan !";
          break;
      case "not_created":
          t = "Terjadi kesalahan dalam menyimpan data Anda !";
          break;
      case "updated":
          t = "Data Anda telah diperbaharui !";
          break;
      case "not_updated":
          t = "Data Anda tidak dapat diperbaharui !";
          break;
      case "404":
          t = "Halaman tidak ditemukan !";
          break;
      case "deleted":
          t = "Data Anda telah dihapus !";
          break;
      case "not_deleted":
          t = "Terjadi kesalahan dalam menghapus data Anda !";
          break;
      case "restored":
          t = "Data Anda telah dikembalikan !";
          break;
      case "not_restored":
          t = "Terjadi kesalahan dalam mengembalikan data Anda !";
          break;
      case "not_selected":
          t = "Tidak ada item terpilih !";
          break;
      case "existed":
          t = "Data sudah tersedia !";
          break;
      case "empty":
          t = "Data tidak tersedia !";
          break;
      case "required":
          t = "Field harus diisi !";
          break;
      case "not_numeric":
          t = "ID bukan tipe angka";
          break;
      case "keyword_empty":
          t = "Kata kunci pencarian tidak boleh kosong, dan minimal 3 karakter !";
          break;
      case "no_changed":
          t = "Tidak ada data yang berubah !";
          break;
      case "logged_in":
          t = "Log In berhasil. Halaman akan dialihkan dalam 2 detik. Jika tidak dialihkan, silahkan refresh browser Anda!</a>";
          break;
      case "not_logged_in":
          t = "Log In gagal. Nama akun dan/atau kata sandi yang Anda masukan salah.";
          break;
      case "forbidden":
          t = "Akses ditolak!";
          break;
      case "extracted":
          t = "Tema berhasil diextract";
          break;
      case "not_extracted":
          t = "Tema gagal diextract";
          break;
      default:
          t = e
  }
  return t
}, String.prototype.ucwords = function() {
  return this.toLowerCase().replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g, function(e) {
      return e.toUpperCase()
  })
}, _H.Loading = function(e) {
  e ? $("body").addClass("loading") : $("body").removeClass("loading")
}, _H.Preview = function(e) {
  if (e.files && e.files[0]) {
      var t = new FileReader;
      t.onload = function(e) {
          $("#preview").attr("src", e.target.result)
      }, t.readAsDataURL(e.files[0])
  }
}, _H.ExportToExcel = function(e, t, n) {
  n = n || "xlsx", t = t + "-" + (new Date).toISOString().replace(/[\-\:\.]/g, "") + "." + n;
  _H.ConvertHTML(e, n, t), $("#" + e).remove()
}, _H.ConvertHTML = function(e, t, n) {
  var i = XLSX.utils.table_to_book(document.getElementById(e), {
          sheet: "Sheet1"
      }),
      o = XLSX.write(i, {
          bookType: t,
          bookSST: !0,
          type: "binary"
      }),
      r = n || "test." + t;
  try {
      saveAs(new Blob([_H.StringToArrayBuffered(o)], {
          type: "application/octet-stream"
      }), r)
  } catch (e) {
      console.log(e, o)
  }
  return o
}, _H.StringToArrayBuffered = function(e) {
  if ("undefined" != typeof ArrayBuffer) {
      for (var t = new ArrayBuffer(e.length), n = new Uint8Array(t), i = 0; i != e.length; ++i) n[i] = 255 & e.charCodeAt(i);
      return t
  }
  for (t = new Array(e.length), i = 0; i != e.length; ++i) t[i] = 255 & e.charCodeAt(i);
  return t
}, _H.SidebarCollapse = function() {
  $.post(_BASE_URL + "dashboard/sidebar_collapse")
}, toastr.options = {
  closeButton: !0,
  debug: !1,
  newestOnTop: !1,
  progressBar: !0,
  positionClass: "toast-top-right",
  preventDuplicates: !0,
  showDuration: "300",
  hideDuration: "1000",
  timeOut: "5000",
  extendedTimeOut: "1000",
  showEasing: "swing",
  hideEasing: "linear",
  showMethod: "fadeIn",
  hideMethod: "fadeOut"
}, $(document).ready(function() {
  $(document).find(".select2").select2({
      width: "100%"
  }), $(document).find("input.date:enabled").datetimepicker({
      format: "yyyy-mm-dd",
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0,
      fontAwesome: !0
  });
  var e = $("#return-to-top");
  $(window).scroll(function() {
      50 <= $(this).scrollTop() ? e.fadeIn(200) : e.fadeOut(200)
  }), e.click(function() {
      $("body,html").animate({
          scrollTop: 0
      }, 500)
  })
}), "undefined" == typeof jQuery) throw new Error("GridBuilder's JavaScript requires jQuery");

function GridBuilder(e, t) {
var n = this;
if (window[e] = n, !t.controller) throw new Error('GridBuilder requires "controller" object key on the 2nd parameter');
if (!t.fields) throw new Error('GridBuilder requires "fields" object on the 2nd parameter');
n.options = $.extend({
  name: e,
  controller: null,
  extra_params: {},
  pagination_action: "pagination",
  delete_action: "delete",
  restore_action: "restore",
  per_page: 10,
  per_page_options: [10, 20, 50, 100, 0],
  page_number: 0,
  total_page: 0,
  total_rows: 0,
  keyword: "",
  fields: [],
  rows: [],
  can_reload: !0,
  can_add: !0,
  can_delete: !0,
  can_restore: !0,
  can_search: !0,
  to_excel: !0,
  sort_field: "",
  sort_type: "ASC",
  resize_column: 3,
  extra_buttons: ""
}, t), $(document).ready(function() {
  n._init()
})
}
if ($(document).keydown(function(e) {
  27 === (e.keyCode ? e.keyCode : e.which) && setTimeout(function() {
      $(".keyword").focus().val(""), $(".search-info").empty(), window[_grid].options.keyword = "", window[_grid].options.page_number = 0, window[_grid].Reload()
  }, 200)
}), function() {
  this._init = function() {
      var e = this.options;
      _H.Loading(!0), this.BuildButtons(), this.HeaderTable(), this.FooterTable(), this.GetData(), this.ResizeColumn(), $(".check-all").click(function() {
          $("input:checkbox").not(this).prop("checked", this.checked)
      }), $(".keyword").attr("onkeypress", e.name + ".Search(event)"), $(".keyword").focus()
  }, this.Reload = function() {
      _H.Loading(!0), this.GetData()
  }, this.BuildButtons = function() {
      var e = this.options,
          t = "";
      e.extra_buttons && (t += e.extra_buttons), e.can_add && (t += '<button title="Add New" onclick="' + e.name + '_FORM.OnShow()" class="btn btn-default btn-flat rounded-0 add" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-plus"></i></button>'), e.can_delete && (t += '<button title="Delete" onclick="' + e.name + '.Delete()" class="btn btn-default btn-flat rounded-0 delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>'), e.can_restore && (t += '<button title="Restore" onclick="' + e.name + '.Restore()" class="btn btn-default btn-flat rounded-0 restore" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fa fa-mail-reply-all"></i></button>'), e.to_excel && (t += '<button title="Save as Excel" onclick="' + e.name + '.ExportExcel()" class="btn btn-default btn-flat rounded-0" data-toggle="tooltip" data-placement="top" title="Save as Excel"><i class="fa fa-file-excel-o"></i></button>'), e.can_search || $("input.keyword").hide(), e.can_reload && (t += '<button title="Reload" onclick="' + e.name + '.OnReload()" class="btn btn-default btn-flat rounded-0 reload" data-toggle="tooltip" data-placement="top" title="Reload"><i class="fa fa-refresh"></i></button>'), $(".grid-button").html(t)
  }, this.HeaderTable = function() {
      var e = this.options.fields,
          t = this.TH("NO");
      if (e.length)
          for (var n in e) {
              var i = !0 === e[n].exclude_excel,
                  o = !1 !== e[n].sorting,
                  r = e[n].header;
              t += this.TH(r, e[n].sort_field || e[n].renderer, i, o)
          }
      $(".thead").html(this.TR(t))
  }, this.GetData = function() {
      var i = this,
          n = i.options;
      try {
          var e = {
              page_number: n.page_number,
              per_page: n.per_page,
              keyword: n.keyword
          };
          if (0 < Object.keys(n.extra_params).length)
              for (var t in n.extra_params) e[t] = n.extra_params[t];
          $.post(_BASE_URL + n.controller + "/" + n.pagination_action, e, function(e) {
              var t = _H.StrToObject(e);
              n.total_page = t.total_page, n.total_rows = t.total_rows, n.rows = t.rows, i.RenderTable(n.rows)
          }).fail(function(e, t, n) {
              e.textStatus = t, (e.errorThrown = n) || (n = "Unable to load resource, network connection or server is down?"), i.Notify("error", t + " " + n + "<br/>" + e.responseText)
          })
      } catch (e) {
          i.Notify("error", e)
      }
  }, this.RenderTable = function(e) {
      var a = this,
          l = a.options;
      if (0 < l.total_rows) {
          l.total_rows <= l.per_page && $(".next").prop("disabled", !0);
          var c = "";
          $.each(e, function(e, t) {
              var n = l.page_number * l.per_page + (e + 1),
                  i = "";
              for (var o in i += a.TD(n + "."), l.fields) {
                  var r = !1;
                  l.fields[o].exclude_excel && (r = !0);
                  var s = a.TransformCell(t, l.fields[o]);
                  i += a.TD(s, r)
              }
              c += a.TRid(t.id, t.is_deleted, i)
          }), $(".tbody").html(c)
      } else $(".tbody").empty(), a.Notify("info", a.Message("empty"));
      a.PaginationInfo(), a.PaginationButton(l.total_page), "" !== $(".keyword").val() && a.SearchInfo(), _H.Loading(!1)
  }, this.FooterTable = function() {
      var e = this.options,
          t = "";
      for (var n in e.per_page_options) t += '<option value="' + e.per_page_options[n] + '">' + (0 == e.per_page_options[n] ? "All" : e.per_page_options[n]) + "</option>";
      $(".per-page").append(t)
  }, this.PaginationButton = function() {
      var e = this.options;
      $(".next").attr("onclick", e.name + ".NextPage()"), $(".previous").attr("onclick", e.name + ".PrevPage()"), $(".first").attr("onclick", e.name + ".FirstPage()"), $(".last").attr("onclick", e.name + ".LastPage()"), $(".per-page").attr("onchange", e.name + ".SetPerPage()"), $(".previous, .first").prop("disabled", 0 == e.page_number), $(".next, .last").prop("disabled", 0 == e.total_page || e.page_number == e.total_page - 1)
  }, this.PaginationInfo = function() {
      var e = this.options,
          t = "Page " + (0 == e.total_rows ? 0 : e.page_number + 1);
      t += " of " + e.total_page.to_money(), t += " &sdot; Total : " + e.total_rows.to_money() + " Rows.", $(".page-info").html(t)
  }, this.SearchInfo = function() {
      var e = this.options,
          t = 1 < e.total_rows ? "s" : "",
          n = ' Your search for <strong>"' + e.keyword + '"</strong>';
      n += " returned " + e.total_rows.to_money() + " result" + t, n += '. <b style="color:red;">Press escape to clear</b>', $(".search-info").html(n)
  }, this.ResizeColumn = function() {
      for (var e = this.options, t = 1; t <= e.resize_column; t++) $("tr th:nth-child(" + t + ")").attr({
          width: "30px"
      })
  }, this.TransformCell = function(e, t) {
      var n = t.renderer,
          i = "";
      switch (typeof n) {
          case "string":
              i = e[n];
              break;
          case "function":
              i = n(e) || " ";
              break;
          default:
              console.error("invalid renderer, renderer must be a string or function", n)
      }
      return i
  }, this.Delete = function() {
      var r = this,
          s = r.options,
          e = 0,
          a = $("input.checkbox:checked");
      a.each(function() {
          e++
      }), 0 < e ? eModal.confirm("Apakah anda yakin data akan dihapus ?", "Konfirmasi").then(function() {
          var e = _BASE_URL + s.controller + "/" + s.delete_action,
              t = [],
              n = 0,
              i = 0;
          if (a.each(function() {
                  var e = $(this).val();
                  $("#tr_" + e).hasClass("delete") || (t[n] = e, n++, i++)
              }), 0 < i) {
              var o = {};
              o.id = t.join(","), $.post(e, o, function(e) {
                  var t = _H.StrToObject(e);
                  r.Notify(t.status, r.Message(t.message)), $("input[type='checkbox']:checked").prop("checked", !1), "delete_permanently" == t.action ? r.Reload() : $.each(t.id, function(e, t) {
                      $("#tr_" + t).hasClass("delete") || $("#tr_" + t).addClass("delete")
                  })
              }).fail(function(e, t, n) {
                  e.textStatus = t, (e.errorThrown = n) || (n = "Unable to load resource, network connection or server is down?"), r.Notify("error", t + " " + n + "<br/>" + e.responseText)
              })
          } else r.Notify("warning", r.Message("not_deleted"))
      }) : r.Notify("info", r.Message("not_selected"))
  }, this.Restore = function() {
      var r = this,
          s = r.options,
          e = 0,
          a = $("input.checkbox:checked");
      a.each(function() {
          e++
      }), 0 < e ? eModal.confirm("Apakah anda yakin data akan dikembalikan ?", "Konfirmasi").then(function() {
          var e = _BASE_URL + s.controller + "/" + s.restore_action,
              t = [],
              n = 0,
              i = 0;
          if (a.each(function() {
                  var e = $(this).val();
                  $("#tr_" + e).hasClass("delete") && (t[n] = e, n++, i++)
              }), 0 < i) {
              var o = {};
              o.id = t.join(","), $.post(e, o, function(e) {
                  var t = _H.StrToObject(e);
                  r.Notify(t.status, r.Message(t.message)), $("input[type='checkbox']:checked").prop("checked", !1), $.each(t.id, function(e, t) {
                      $("#tr_" + t).hasClass("delete") && $("#tr_" + t).removeClass("delete")
                  })
              }).fail(function(e, t, n) {
                  e.textStatus = t, (e.errorThrown = n) || (n = "Unable to load resource, network connection or server is down?"), r.Notify("error", t + " " + n + "<br/>" + e.responseText)
              })
          } else r.Notify("warning", r.Message("not_restored"))
      }) : r.Notify("info", r.Message("not_selected"))
  }, this.NextPage = function() {
      var e = this.options;
      _H.Loading(!0), this.CursorFocused(), e.page_number++, this.Reload()
  }, this.PrevPage = function() {
      var e = this.options;
      _H.Loading(!0), this.CursorFocused(), e.page_number--, this.Reload()
  }, this.FirstPage = function() {
      var e = this.options;
      _H.Loading(!0), this.CursorFocused(), e.page_number = 0, this.Reload()
  }, this.LastPage = function() {
      var e = this.options;
      _H.Loading(!0), this.CursorFocused(), e.page_number = e.total_page - 1, this.Reload()
  }, this.SetPerPage = function() {
      var e = this.options;
      _H.Loading(!0), this.CursorFocused(), e.page_number = 0, e.per_page = $(".per-page option:selected").val(), this.Reload()
  }, this.OnReload = function() {
      _H.Loading(!0), this.CursorFocused(), this.Reload()
  }, this.Search = function(e) {
      _H.Loading(!0), 13 === (e.keyCode ? e.keyCode : e.which) ? (this.options.keyword = $(".keyword").val(), this.options.page_number = 0, this.Reload()) : _H.Loading(!1)
  }, this.CursorFocused = function() {
      $("input.keyword").focus()
  }, this.TR = function(e) {
      return "<tr>" + e + "</tr>"
  }, this.TRid = function(e, t, n) {
      return "true" == t ? '<tr id="tr_' + e + '" class="delete highlight">' + n + "</tr>" : '<tr id="tr_' + e + '">' + n + "</tr>"
  }, this.TH = function(e, t, n, i) {
      var o = "",
          r = "",
          s = [];
      if ("string" == typeof t && s.push("field_" + t), n && s.push("exclude_excel"), i && (s.push("sorting"), s.push("sort_both")), s.length && (r = 'class="' + s.join(" ") + '"'), i) {
          t = "'" + t + "'";
          o = 'onclick="' + (this.options.name + ".Sorting(" + t + ")") + '"'
      }
      return "<th " + r + " " + o + ' data-sort="ASC">' + e + "</th>"
  }, this.Sorting = function(e) {
      var t = this.options,
          n = $("th.field_" + e),
          i = n.attr("data-sort");
      $($(".table").find("th.sorting")).removeClass("sort_asc sort_desc").addClass("sort_both"), "ASC" == i ? ($(n).attr("data-sort", "DESC"), $(n).removeClass("sort_both sort_desc").addClass("sort_asc")) : ($(n).attr("data-sort", "ASC"), $(n).removeClass("sort_both sort_asc").addClass("sort_desc")), t.rows.sort(this.SortTable(e, i)), this.RenderTable(t.rows)
  }, this.SortTable = function(r, s) {
      return function(e, t) {
          if (!e.hasOwnProperty(r) || !t.hasOwnProperty(r)) return 0;
          var n = "string" == typeof e[r] ? e[r].toUpperCase() : e[r],
              i = "string" == typeof t[r] ? t[r].toUpperCase() : t[r],
              o = 0;
          return i < n ? o = 1 : n < i && (o = -1), "DESC" == s ? -1 * o : o
      }
  }, this.TD = function(e, t) {
      return "<td " + (t ? 'class="exclude_excel"' : "") + ">" + e + "</td>"
  }, this.Notify = function(e, t) {
      switch (e) {
          case "success":
              toastr.success(t, "Sukses");
              break;
          case "info":
              toastr.info(t, "Informasi");
              break;
          case "warning":
              toastr.warning(t, "Peringatan");
              break;
          case "error":
              toastr.error(t, "Terjadi kesalahan");
              break;
          default:
              toastr.error("Tipe kesalahan tidak diketahui.")
      }
  }, this.Message = function(e) {
      var t;
      switch (e) {
          case "not_selected":
              t = "Tidak ada item yang terpilih!";
              break;
          case "restored":
              t = "Data berhasil dikembalikan!";
              break;
          case "not_restored":
              t = "Terjadi kesalahan. Data tidak berhasil dikembalikan!";
              break;
          case "deleted":
              t = "Data berhasil dihapus!";
              break;
          case "not_deleted":
              t = "Terjadi kesalahan. Data tidak berhasil dihapus!";
              break;
          case "empty":
              t = "Data tidak ditemukan!";
              break;
          default:
              t = e
      }
      return t
  }, this.ExportExcel = function(e) {
      e = e || "xlsx";
      var t = "table-renderer";
      $('<div id="table-renderer" style="display: none;"></div>').appendTo(document.body);
      var n = $(".data-table-renderer").html();
      $("#" + t).html(n);
      var i = $(".table-header").text() + "-" + (new Date).toISOString().replace(/[\-\:\.]/g, "") + "." + e;
      this.ConvertHTML(t, e, i), $("#" + t).remove()
  }, this.ConvertHTML = function(e, t, n) {
      var i = XLSX.utils.table_to_book(document.getElementById(e), {
              sheet: "Sheet1"
          }),
          o = XLSX.write(i, {
              bookType: t,
              bookSST: !0,
              type: "binary"
          }),
          r = n || "test." + t;
      try {
          saveAs(new Blob([this.StringToArrayBuffered(o)], {
              type: "application/octet-stream"
          }), r)
      } catch (e) {
          console.log(e, o)
      }
      return o
  }, this.StringToArrayBuffered = function(e) {
      if ("undefined" != typeof ArrayBuffer) {
          for (var t = new ArrayBuffer(e.length), n = new Uint8Array(t), i = 0; i != e.length; ++i) n[i] = 255 & e.charCodeAt(i);
          return t
      }
      for (t = new Array(e.length), i = 0; i != e.length; ++i) t[i] = 255 & e.charCodeAt(i);
      return t
  }
}.call(GridBuilder.prototype), "undefined" == typeof jQuery) throw new Error("FormBuilder's JavaScript requires jQuery");

function FormBuilder(e, t) {
if (window[e] = this, !t.controller) throw new Error('FormBuilder requires "controller" object key on the 2nd parameter');
if (!t.fields) throw new Error('FormBuilder requires "fields" object on the 2nd parameter');
this.options = $.extend({
  id: 0,
  name: e,
  controller: null,
  extra_params: {},
  save_action: "save",
  form_action: "find_id",
  upload_action: "upload",
  fields: []
}, t)
}(function() {
this.OnEdit = function(e) {
  var i = this,
      r = i.options;
  r.id = e || 0, i.RenderForm(), $(".modal-form").modal({
      show: !0,
      backdrop: "static"
  }), _H.Loading(!0), $.post(_BASE_URL + r.controller + "/" + r.form_action, {
      id: e
  }, function(e) {
      var t = _H.StrToObject(e);
      for (var n in r.fields) {
          var i = r.fields[n],
              o = $("#" + i.name);
          if (o.val(""), "password" !== i.type) switch (i.type) {
              case "number":
              case "float":
                  o.val(t[i.name] || 0);
                  break;
              case "select":
                  o.val(t[i.name]).trigger("change");
                  break;
              default:
                  o.val(t[i.name])
          }
      }
      _H.Loading(!1)
  }).fail(function(e, t, n) {
      e.textStatus = t, (e.errorThrown = n) || (n = "Unable to load resource, network connection or server is down?"), i.Notify("error", t + " " + n + "<br/>" + e.responseText)
  }), $(".modal-dialog").addClass("modal-lg"), $(".reset").hide(), $(".submit").show().html('<i class="fa fa-save"></i> UPDATE'), $(".submit").attr("onclick", r.name + ".Submit(event)"), $(".form-horizontal").removeAttr("id enctype")
}, this.Submit = function(e) {
  e.preventDefault();
  var i = this,
      o = i.options,
      t = $(".form-fields").find(":input").serializeArray(),
      n = {};
  for (var r in n.id = o.id, t) n[t[r].name] = t[r].value;
  if (0 < Object.keys(o.extra_params).length)
      for (var r in o.extra_params) n[r] = o.extra_params[r];
  var s = $(".form-fields").find('input[type="checkbox"]');
  s.length && s.each(function() {
      n[this.name] = this.checked.toString()
  }), _H.Loading(!0), $.post(_BASE_URL + o.controller + "/" + o.save_action, n, function(e) {
      var t = _H.StrToObject(e);
      if (i.Notify(t.status, i.Message(t.message)), "success" == t.status) {
          var n = o.name.split("_FORM");
          window[n[0]].Reload(), $(".modal-form").modal("hide")
      }
      _H.Loading(!1)
  }).fail(function(e, t, n) {
      e.textStatus = t, (e.errorThrown = n) || (n = "Unable to load resource, network connection or server is down ?"), i.Notify("error", t + " " + n + "<br/>" + e.responseText)
  })
}, this.OnShow = function() {
  var e = this.options;
  for (var t in e.id = 0, _H.Loading(!0), this.RenderForm(), $(".modal-form").modal({
          show: !0,
          backdrop: "static"
      }), e.fields) {
      var n = e.fields[t];
      "number" !== n.type && "float" !== n.type || $("#" + n.name).val(0)
  }
  $(".modal-dialog").addClass("modal-lg"), $(".reset").show(), $(".submit").show().html('<i class="fa fa-save"></i> SAVE'), $(".submit").attr("onclick", e.name + ".Submit(event)"), $(".form-horizontal").removeAttr("id enctype"), _H.Loading(!1)
}, this.OnUpload = function(e) {
  var t = this.options;
  t.id = e || 0, 0 < e && (this.RenderFormUpload(), $(".modal-dialog").removeClass("modal-lg"), $(".reset").hide(), $(".submit").show().html('<i class="fa fa-upload"></i> UPLOAD'), $(".submit").attr("onclick", t.name + ".Upload(event)"), $(".modal-form").modal({
      show: !0,
      backdrop: "static"
  }))
}, this.Upload = function(e) {
  e.preventDefault();
  var i = this,
      o = i.options,
      t = new FormData;
  t.append("id", o.id), t.append("file", $('input[type="file"]')[0].files[0]), $.ajax({
      url: _BASE_URL + o.controller + "/" + o.upload_action,
      type: "POST",
      data: t,
      contentType: !1,
      processData: !1,
      success: function(e) {
          var t = _H.StrToObject(e);
          "error" == t.action ? i.Notify(t.status, t.message) : i.Notify(t.status, i.Message(t.message));
          var n = o.name.split("_FORM");
          window[n[0]].Reload(), $(".modal-form").modal("hide")
      }
  })
}, this.RenderForm = function() {
  var e = this.options,
      t = "";
  for (var n in e.fields) t += this.RenderField(e.fields[n]);
  $(".form-fields").empty().html(t), $(document).find("input.date:enabled").datetimepicker({
      format: "yyyy-mm-dd",
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0,
      fontAwesome: !0
  }), $(document).find("input.datetime:enabled").datetimepicker({
      format: "yyyy-mm-dd hh:ii:ss",
      todayBtn: !0,
      minDate: "0001-01-01",
      setDate: new Date,
      todayHighlight: !0,
      autoclose: !0,
      minuteStep: 5,
      startView: 2,
      fontAwesome: !0
  }), $(document).find("input.time:enabled").datetimepicker({
      format: "hh:ii:ss",
      weekStart: 1,
      autoclose: 1,
      startView: 1,
      minView: 0,
      maxView: 1,
      forceParse: 0,
      fontAwesome: !0
  }), $(document).find(".select2:enabled").select2(), $(".number").number(!0, 0), $(".float").number(!0, 2)
}, this.RenderFormUpload = function() {
  var e = this.RenderField({
      name: "file",
      type: "file",
      label: ""
  });
  $(".form-fields").empty().html(e)
}, this.RenderField = function(e) {
  var t = '<div class="form-group">';
  switch (t += '<label class="col-sm-4 control-label" for="' + e.name + '">' + e.label + "</label>", t += '<div class="col-sm-8">', e.type) {
      case "number":
          t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm number" style="text-align:right;" id="' + e.name + '" name="' + e.name + '">';
          break;
      case "float":
          t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm float" style="text-align:right;" id="' + e.name + '" name="' + e.name + '">';
          break;
      case "email":
          t += '<div class="input-group">', t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">', t += '<div class="input-group-addon input-sm"><i class="fa fa-envelope-o"></i></div>', t += "</div>";
          break;
      case "textarea":
          t += '<textarea rows="5" class="form-control input-sm" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '"></textarea>';
          break;
      case "select":
          if (t += '<select style="width:100%" class="form-control select2" ' + (e.required ? "required" : "") + ' id="' + e.name + '" name="' + e.name + '">', Object.keys(e.datasource).length)
              for (var n in e.datasource) t += '<option value="' + n + '">' + e.datasource[n] + "</option>";
          t += "</select>";
          break;
      case "password":
          t += '<div class="input-group">', t += '<input autocomplete="off" type="password" ' + (e.required ? "required" : "") + ' class="form-control input-sm" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">', t += '<div class="input-group-addon input-sm"><i class="fa fa-key"></i></div>', t += "</div>";
          break;
      case "file":
          t += '<input id="' + e.name + '" type="file" name="' + e.name + '" style="margin-top:8px;">';
          break;
      case "image":
          t += '<input onchange="' + this.Preview(this) + '" type="file" ' + (e.required ? "required" : "") + ' id="' + e.name + '" name="' + e.name + '" style="margin-top:8px;">', t += '<img id="preview" style="margin:10px 0; max-width:450px;">';
          break;
      case "checkbox":
          t += '<input type="checkbox" ' + (e.required ? "required" : "") + ' id="' + e.name + '" name="' + e.name + '" style="margin-top:8px;width:20px;height:20px;">';
          break;
      case "date":
          t += '<div class="input-group date">', t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm date" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">', t += '<div class="input-group-addon input-sm"><i class="fa fa-calendar"></i></div>', t += "</div>";
          break;
      case "time":
          t += '<div class="input-group">', t += '<input type="text" class="form-control time input-sm" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">', t += '<div class="input-group-addon input-sm"><i class="fa fa-clock-o"></i></div>', t += "</div>";
          break;
      case "datetime":
          t += '<div class="input-group">', t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm datetime" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">', t += '<div class="input-group-addon input-sm"><i class="fa fa-calendar"></i></div>', t += "</div>";
          break;
      default:
          t += '<input type="text" ' + (e.required ? "required" : "") + ' class="form-control input-sm" id="' + e.name + '" name="' + e.name + '" placeholder="' + (e.placeholder ? e.placeholder : "") + '">'
  }
  return t += "</div></div>"
}, this.Preview = function(e) {
  if (e.files && e.files[0]) {
      var t = new FileReader;
      t.onload = function(e) {
          $("#preview").attr("src", e.target.result)
      }, t.readAsDataURL(e.files[0])
  }
}, this.Notify = function(e, t) {
  switch (e) {
      case "success":
          toastr.success(t, "Sukses");
          break;
      case "info":
          toastr.info(t, "Informasi");
          break;
      case "warning":
          toastr.warning(t, "Peringatan");
          break;
      case "error":
          toastr.error(t, "Terjadi kesalahan");
          break;
      default:
          toastr.error("Tipe kesalahan tidak diketahui.")
  }
}, this.Message = function(e) {
  var t;
  switch (e) {
      case "created":
          t = "Data berhasil disimpan.";
          break;
      case "not_created":
          t = "Data gagal tersimpan.";
          break;
      case "updated":
          t = "Data berhasil diperbaharui.";
          break;
      case "not_updated":
          t = "Data gagal diperbaharui.";
          break;
      case "uploaded":
          t = "File berhasil diunggah.";
          break;
      case "not_uploaded":
          t = "File gagal diunggal.";
          break;
      case "email_send":
          t = "Email berhasil dikirim";
          break;
      case "email_not_send":
          t = "Email tidak berhasil dikirim";
          break;
      default:
          t = e
  }
  return t
}
}).call(FormBuilder.prototype);