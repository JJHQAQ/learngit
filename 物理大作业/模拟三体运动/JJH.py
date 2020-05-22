import numpy as np
import matplotlib.pyplot as plt

class Node:
    x = 0
    y = 0
    m = 0
    a_x = 0
    a_y = 0
    v_x = 0
    v_y = 0
    x_all = []
    y_all = []
    def __init__(self,x,y,v_x,v_y,m):
        self.x = x
        self.y = y
        self.v_x = v_x
        self.v_y = v_y
        self.m = m
    def next(self,t):
        self.v_x = self.v_x+self.a_x*t
        self.v_y = self.v_y+self.a_y*t
        self.x = self.x+self.v_x*t
        self.y = self.y+self.v_y*t
        self.x_all = np.append(self.x_all,self.x)
        self.y_all = np.append(self.y_all,self.y)
A = Node(250,60,0,0,15)
B = Node(-120,-200,0,0,12)
C = Node(-100,150,0,0,8)
G = 100
t = 0.3
plt.ion()
for tim in range(2500):
    r12 = np.sqrt((A.x-B.x)**2+(A.y-B.y)**2)
    r13 = np.sqrt((A.x-C.x)**2+(A.y-C.y)**2)
    r23 = np.sqrt((C.x-B.x)**2+(C.y-B.y)**2)
    r12 = max(r12,10)
    r23 = max(r23,10)
    r13 = max(r13,10)
    #物体A
    a12 = G*B.m/(r12**2)
    a13 = G*C.m/(r13**2)
    A.a_x = a12*((B.x-A.x)/r12)+a13*((C.x-A.x)/r13)
    A.a_y = a12*((B.y-A.y)/r12)+a13*((C.y-A.y)/r13)
    A.next(t)

    #物体B
    a21 = G*A.m/(r12**2)
    a23 = G*C.m/(r23**2)
    B.a_x = a21*(A.x-B.x)/r12+a23*(C.x-B.x)/r23
    B.a_y = a21*(A.y-B.y)/r12+a23*(C.y-B.y)/r23
    B.next(t)

    #物体C
    a31 = G*A.m/(r13**2)
    a32 = G*B.m/(r23**2)
    C.a_x = a31*(A.x-C.x)/r13+a32*(B.x-C.x)/r23
    C.a_y = a31*(A.y-C.y)/r13+a32*(B.y-C.y)/r23
    C.next(t)

    # if (r12<=10):
    #     vx = A.v_x
    #     vy = A.v_y
    #     A.v_x = ((A.m-B.m)*A.v_x+2*B.m*B.v_x)/(A.m+B.m)
    #     A.v_y = ((A.m-B.m)*A.v_y+2*B.m*B.v_y)/(A.m+B.m)
    #     B.v_x = ((B.m-A.m)*B.v_x+2*A.m*vx)/(A.m+B.m)
    #     B.v_y = ((B.m-A.m)*B.v_y+2*A.m*vy)/(A.m+B.m)
    # if (r23<=10):
    #     vx = C.v_x
    #     vy = C.v_y
    #     C.v_x = ((C.m-B.m)*C.v_x+2*B.m*B.v_x)/(C.m+B.m)
    #     C.v_y = ((C.m-B.m)*C.v_y+2*B.m*B.v_y)/(C.m+B.m)
    #     B.v_x = ((B.m-A.m)*B.v_x+2*C.m*vx)/(C.m+B.m)
    #     B.v_y = ((B.m-A.m)*B.v_y+2*C.m*vy)/(C.m+B.m)
    # if (r13<=10):
    #     vx = A.v_x
    #     vy = A.v_y
    #     A.v_x = ((A.m-C.m)*A.v_x+2*C.m*C.v_x) /(A.m+C.m)
    #     A.v_y = ((A.m-C.m)*A.v_y+2*C.m*C.v_y) /(A.m+C.m)
    #     C.v_x = ((C.m-A.m)*C.v_x+2*A.m*vx) /(A.m+C.m)
    #     C.v_y = ((C.m-A.m)*C.v_y+2*A.m*vy) /(A.m+C.m)
    centerx = (A.x+B.x+C.x)/3
    centery = (A.y+B.y+C.y)/3
    obmax = max(r12,max(r23,r13))*2

    plt.clf()
    plt.title("JJH's three body simulation")
    plt.plot(A.x,A.y,"og",markersize=A.m)
    plt.plot(B.x,B.y,"or",markersize=B.m)
    plt.plot(C.x,C.y,"ob",markersize=C.m)
    plt.plot(A.x_all,A.y_all,"-g")
    plt.plot(B.x_all,B.y_all,"-r")
    plt.plot(C.x_all,C.y_all,"-b")
    plt.axis([centerx-obmax,centerx+obmax,centery-obmax,centery+obmax])
    plt.show()
    plt.pause(0.0001)



