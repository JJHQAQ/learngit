from matplotlib import pyplot as plt
from mpl_toolkits.mplot3d import Axes3D
import numpy as np


class Node:
    x = 0
    y = 0
    z = 0
    m = 0
    a_x = 0
    a_y = 0
    a_z = 0
    v_x = 0
    v_y = 0
    v_z = 0
    x_all = []
    y_all = []
    z_all = []
    def __init__(self,x,y,z,v_x,v_y,v_z,m):
        self.x = x
        self.y = y
        self.z = z
        self.v_x = v_x
        self.v_y = v_y
        self.v_z = v_z
        self.m = m
    def next(self,t):
        self.v_x = self.v_x+self.a_x*t
        self.v_y = self.v_y+self.a_y*t
        self.v_z = self.v_z+self.a_z*t
        self.x = self.x+self.v_x*t
        self.y = self.y+self.v_y*t
        self.z = self.z+self.v_z*t
        self.x_all = np.append(self.x_all,self.x)
        self.y_all = np.append(self.y_all,self.y)
        self.z_all = np.append(self.z_all,self.z)

# fig = plt.figure()
plt.ion()

A = Node(0,0,0,1,0,1,5)#green
B = Node(150,150,0,0,1,0,5)#blue
C = Node(75,75,75,0,0,-1,5)#red
G = 50
t = 0.3

while(True):


    r12 = np.sqrt((A.x - B.x) ** 2 + (A.y - B.y) ** 2+(A.z-B.z)**2)
    r13 = np.sqrt((A.x - C.x) ** 2 + (A.y - C.y) ** 2+(A.z-C.z)**2)
    r23 = np.sqrt((C.x - B.x) ** 2 + (C.y - B.y) ** 2+(C.z-B.z)**2)
    # R12 = np.sqrt((A.x - B.x) ** 2 + (A.y - B.y) ** 2)
    # R13 = np.sqrt((A.x - C.x) ** 2 + (A.y - C.y) ** 2)
    # R23 = np.sqrt((C.x - B.x) ** 2 + (C.y - B.y) ** 2)
    r12 = max(r12, 5)
    r23 = max(r23, 5)
    r13 = max(r13, 5)

    # 物体A

    a12 = G * B.m / (r12 ** 2)
    a13 = G * C.m / (r13 ** 2)
    A.a_x = a12 * ((B.x - A.x) / r12) + a13 * ((C.x - A.x) / r13)
    A.a_y = a12 * ((B.y - A.y) / r12) + a13 * ((C.y - A.y) / r13)
    A.a_z = a12 * ((B.z - A.z) / r12) + a13 * ((C.z - A.z) / r13)
    A.next(t)

    # 物体B
    a21 = G * A.m / (r12 ** 2)
    a23 = G * C.m / (r23 ** 2)
    B.a_x = a21 * (A.x - B.x) / r12 + a23 * (C.x - B.x) / r23
    B.a_y = a21 * (A.y - B.y) / r12 + a23 * (C.y - B.y) / r23
    B.a_z = a21 * (A.z - B.z) / r12 + a23 * (C.z - B.z) / r23
    B.next(t)

    # 物体C
    a31 = G * A.m / (r13 ** 2)
    a32 = G * B.m / (r23 ** 2)
    C.a_x = a31 * (A.x - C.x) / r13 + a32 * (B.x - C.x) / r23
    C.a_y = a31 * (A.y - C.y) / r13 + a32 * (B.y - C.y) / r23
    C.a_z = a31 * (A.z - C.z) / r13 + a32 * (B.z - C.z) / r23
    C.next(t)

    obmax = max(r12, max(r23, r13)) * 1
    centerx = (A.x + B.x + C.x) / 3
    centery = (A.y + B.y + C.y) / 3
    centerz = (A.z + B.z + C.z) / 3
    ax1 = plt.axes(projection='3d')
    plt.title("JJH's three body simulation")
    ax1.scatter(A.x,A.y,A.z,zdir='z', s=A.m, c='green')
    ax1.scatter(B.x,B.y,B.z,zdir='z', s=B.m, c='blue')
    ax1.scatter(C.x,C.y,C.z, zdir='z', s=C.m, c='red')
    ax1.plot(A.x_all,A.y_all,A.z_all,"green")
    ax1.plot(B.x_all,B.y_all,B.z_all, "blue")
    ax1.plot(C.x_all, C.y_all, C.z_all, "red")
    ax1.set_zlim3d(centerz-obmax,centerz+obmax)
    ax1.set_xlim3d(centerx-obmax,centerx+obmax)
    ax1.set_ylim3d(centery-obmax,centery+obmax)
    plt.show()
    plt.pause(0.000000005)
    plt.clf()