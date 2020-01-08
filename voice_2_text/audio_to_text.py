def audio_to_text(output, language):    # cli/file | en-US/ru
    import speech_recognition as speech_recog, pyaudio
    
    mic = speech_recog.Microphone()
    with mic as audio_file:
        
        print("Скажите что-нибудь по: {}".format(language))
        speech_recog.Recognizer().adjust_for_ambient_noise(audio_file)
        audio = speech_recog.Recognizer().listen(audio_file)
        print("Audio recognition...")
        
        try:
            result = speech_recog.Recognizer().recognize_google(audio, language='{}'.format(language))
        except Exception as e:
            print("Recongition error! " + str(e))
            
        if output == 'cli':
            print("Ваш текст: '" + result + "'")
        elif output == 'file':
            print("Текст сохранен в /audio_recog")
            with open("audio_recog/sample.txt", "w") as text_file:
                text_file.write("{}".format(result))
        else:
            print("Not supported output format!")
            
           
audio_to_text(output='cli', language='ru')
audio_to_text(output='file', language='ru')
audio_to_text(output='kek', language='ru')
