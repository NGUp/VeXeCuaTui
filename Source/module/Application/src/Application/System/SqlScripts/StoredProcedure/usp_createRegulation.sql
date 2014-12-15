-- Thêm một sự kiện Khuyến mãi
--
-- usp_createRegulation 'DG2014', '03/10/2014', '09/07/2015', '-10', N'Đám giỗ'

Create Procedure usp_createRegulation
	@id nchar(10),
	@dateFrom char(10),
	@dateTo char(10),
	@percent int,
	@reason nvarchar(255)
As
Begin
	Insert Into DieuTietGiaVe(MaDT, NgayBatDau, NgayKetThuc, PhanTram, LyDo)
	Values(@id, Convert(date, @dateFrom, 103), Convert(date, @dateTo, 103), @percent, @reason)
End
