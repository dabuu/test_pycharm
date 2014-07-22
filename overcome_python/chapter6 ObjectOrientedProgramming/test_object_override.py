# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

# print "===================== method override =====================";

class Human(object):
    name = "";
    __age = 0;

    def __init__(self, name, age):
        self.name = name;
        self.__age = age;

    def showinfo(self):
        print "name is : " + self.name + "; age is: " + str(self.__age);

class Student(Human):
    grade = 1;

    def __init__(self, name, age, grade):
        super(Student, self).__init__(name,age);
        self.grade = grade;

    # def showinfo(self):
    #     super(Student,self).showinfo();
    #     print "my grade is : " + str(self.grade);

#
# stu = Student("wangyue", 30, 3);
# stu.showinfo();
#
# print "===================== operator override =====================";

class MyList:
    __myList = [];

    def __init__(self, *args):
        self.__myList =[];
        for a in args:
            self.__myList.append(a);

    def __add__(self, n):
        for i in range(0, len(self.__myList), 1):
            self.__myList[i] += n;
        self.show();

    def __sub__(self, n):
        for i in range(0, len(self.__myList), 1):
            self.__myList[i] -= n;
        self.show();

    def __mul__(self, n):
        for i in range(0, len(self.__myList), 1):
            self.__myList[i] *= n;
        self.show();

    def __div__(self, n):
        for i in range(0, len(self.__myList), 1):
            self.__myList[i] /= n;
        self.show();

    def __mod__(self, n):
        for i in range(0, len(self.__myList), 1):
            self.__myList[i] %= n;
        self.show();

    def __len__(self):
        return len(self.__myList);

    def show(self):
        print self.__myList;

# mlist = MyList(1,2,3,4,5);
#
# mlist.show();
# mlist.__add__(5);
# mlist.__sub__(1);
# mlist.__mul__(3);
# mlist.__div__(3);
# mlist.__mod__(2);
# print len(mlist);
#
# anotherList = mlist;
# anotherList.show();