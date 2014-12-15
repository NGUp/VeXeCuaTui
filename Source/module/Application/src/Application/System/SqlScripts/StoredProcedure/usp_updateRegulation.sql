-- Cập nhật Điều tiết giá vé
--
-- usp_updateRegulation 'DG2014', '2014-11-12', '2014-11-28', -20, N'Đám giỗ'

Create Procedure usp_updateRegulation
	@id nchar(10),
	@dateFrom char(10),
	@dateTo char(10),
	@percent int,
	@reason nvarchar(255)
As
Begin
	Update DieuTietGiaVe
	Set NgayBatDau = Convert(date, @dateFrom, 103), NgayKetThuc = Convert(date, @dateTo, 103), PhanTram = @percent, LyDo = @reason
	Where MaDT = @id
End