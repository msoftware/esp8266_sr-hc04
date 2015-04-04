
trigger = 1
echo = 4

gpio.mode(trigger,gpio.OUTPUT)
gpio.mode(echo,gpio.INPUT)

wifi.setmode(wifi.STATION)
wifi.sta.config("SSID","WIFI PASSWORD")
wifi.sta.connect()
 
tmr.alarm(0, 1000, 1, function() 
   if wifi.sta.getip()==nil then
      print("connecting to AP...") 
   else
      print('ip: ',wifi.sta.getip())
      tmr.stop(0)
      tmr.alarm(1,1000,1,function() 
        dist = measure_HC_SR04(trigger,echo)
        send_to_server (dist)
      end)
   end
end)

function send_to_server (dist)
  print (dist)
  conn=net.createConnection(net.TCP, 0)
    conn:on("receive", function(conn, payload) print(payload) end )
    conn:connect(80,"XX.XX.XX.XX") -- enter your host IP here
    conn:send("GET /sr-hc04/insert.php?sensor=HC_SR04_001&data="
        .. dist
        .." HTTP/1.1\r\nHost: HOST.NAME\r\n"  -- enter your host name here
        .."Connection: keep-alive\r\nAccept: */*\r\n\r\n")
end

function measure_HC_SR04(trigger, echo)
  gpio.write(trigger, gpio.LOW)
  dist = 0
  for variable = 0, 200, 1 do
    dist = dist + gpio.read(echo)
  end  
  gpio.write(trigger, gpio.HIGH)
  return dist
end

