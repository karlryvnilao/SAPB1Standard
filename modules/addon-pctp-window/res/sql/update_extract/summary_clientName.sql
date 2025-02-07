-- PRINT 'BEFORE TRY'
-- BEGIN TRY
--     BEGIN TRAN
--     PRINT 'First Statement in the TRY block'

-------->>CREATING TARGETS
    
    DROP TABLE IF EXISTS TMP_TARGET
    SELECT

    T0.U_BookingNumber AS U_BookingNumber,
    T1.CardName AS U_ClientName

    INTO TMP_TARGET

    FROM [dbo].[@PCTP_POD] T0  WITH (NOLOCK)
        LEFT JOIN OCRD T1 ON T1.CardCode = T0.U_SAPClient

-------->>SUMMARY_EXTRACT

    UPDATE SUMMARY_EXTRACT
    SET U_ClientName = TMP.U_ClientName
    FROM TMP_TARGET TMP
    WHERE TMP.U_BookingNumber = SUMMARY_EXTRACT.U_BookingNumber

-------->>DELETING TMP_TARGET

    DROP TABLE IF EXISTS TMP_TARGET

--     PRINT 'Last Statement in the TRY block'
--     COMMIT TRAN
-- END TRY
-- BEGIN CATCH
--     PRINT 'In CATCH Block'
--     IF(@@TRANCOUNT > 0)
--         ROLLBACK TRAN;

--     THROW; -- raise error to the client
-- END CATCH
-- PRINT 'After END CATCH'